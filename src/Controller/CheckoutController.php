<?php

namespace App\Controller;

use App\Entity\Coupon;
use App\Entity\Order;
use App\Entity\OrderItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\PropertyAccess\PropertyAccess;

class CheckoutController extends Controller
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        if (!$this->session->has('cart')) {
            return $this->redirectToRoute('home');
        }
    }
    /**
     * @Route("/checkout", name="checkout")
     * @Method({"GET"})
     */
    public function index()
    {
        $cart = $this->session->get('cart');
        return $this->render('checkout.html.twig', array('cart' => $cart));
    }
    /**
     * @Route("/checkout/submit")
     * @Method({"POST"})
     */
    public function submit(Request $request, ValidatorInterface $validator)
    {
        $constraints = new Assert\Collection([
            'first_name' => [new Assert\Length(['max' => 191]), new Assert\NotBlank],
            'last_name' => [new Assert\Length(['max' => 191])],
            'phone' => [new Assert\Length(['max' => 20]), new Assert\NotBlank],
            'email' => [new Assert\Email()],
            'address_line_1' => [new Assert\Length(['max' => 191]), new Assert\NotBlank],
            'address_line_2' => [new Assert\Length(['max' => 191])],
            'city' => [new Assert\Length(['max' => 191]), new Assert\NotBlank],
            'note' => [new Assert\Length(['max' => 191])],
        ]);

        $violations = $validator->validate($request->request->all(), $constraints);

        if (count($violations) > 0) {

            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation) {

                $accessor->setValue(
                    $errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage()
                );
            }

            return new JsonResponse(array('status' => 'error', 'errors' => $errorMessages));
        } else {

            $cart = $this->session->get('cart');

            $order = new Order();

            $order->setRefNo('REF' . rand(1000, 999));
            $order->setFirstName($request->get('first_name'));
            $order->setLastName($request->get('last_name'));
            $order->setPhone($request->get('phone'));
            $order->setEmail($request->get('email'));
            $order->setAddressLine1($request->get('address_line_1'));
            $order->setAddressLine2($request->get('address_line_2'));
            $order->setCity($request->get('city'));
            $order->setNote($request->get('note'));
            $order->setGrossTotal($cart["gross_total"]);
            $order->setDiscount($cart["discount"]);
            $order->setCouponDiscount($cart["coupon_discount"]);
            $order->setNetTotal($cart["net_total"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            foreach ($cart["items"] as $key => $value) {
                $order_item = new OrderItem();

                $order_item->setOrder($order->getId());
                $order_item->setBook($value["id"]);
                $order_item->setQty($value["qty"]);
                $order_item->setUnitPrice($value["unit_price"]);
                $order_item->setTotalPrice($value["total_price"]);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($order_item);
                $entityManager->flush();
            }
        }
        return new JsonResponse(array('status' => 'success', 'message' => 'Order submitted'), 200);
    }

    /**
     * @Route("/checkout/coupon-varify")
     * @Method({"POST"})
     */
    public function couponVarify(Request $request)
    {
        $cart = $this->session->get('cart');
        $code = $request->get('code');
        $coupon = $this->getDoctrine()->getRepository(Coupon::class)->findByCode($code);
        if ($coupon) {
            $coupon_discount = $cart["gross_total"] * $coupon->getRate() / 100;

            $net_total = $cart["gross_total"] - $coupon_discount;
            $this->session->set('cart', [
                'gross_total' => $cart["gross_total"],
                'discount' => 0,
                'coupon_discount' => $coupon_discount,
                'net_total' => $net_total,
                'items' => $cart["items"]
            ]);

            $data = [
                'discount' => '0.00',
                'coupon_discount' => number_format($coupon_discount, 2),
                'net_total' => number_format($net_total, 2)
            ];

            return new JsonResponse(array('status' => 'success', 'message' => 'Coupon varified', 'data' => $data), 200);
        } else {
            return new JsonResponse(array('status' => 'error', 'message' => 'Invalid coupon'), 422);
        }
    }
}

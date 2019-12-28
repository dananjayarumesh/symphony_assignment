<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Book;

class CartController extends Controller
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        // $this->session->set('cart',NULL);
        // $this->session->invalidate();
        if (!$this->session->has('cart')) {
            $this->initCart();
        }
    }

    /**
     * @Route("/cart", name="cart")
     * @Method({"GET"})
     */
    public function index()
    {

        // if (!$this->session->has('cart')) { } else { }
        $cart = $this->session->get('cart');
        if (!$cart) {
            $this->initCart();
        }
        dump($cart);
        return $this->render('cart.html.twig', array('cart' => $cart));
    }

    /**
     * @Route("/cart/get-count")
     * @Method({"POST"})
     */
    public function getCount()
    {
        $count = 0;
        if ($this->session->has('cart')) {
            $cart = $this->session->get('cart');
            $items = $cart["items"];
            if (is_array($items)) {
                foreach ($items as $key => $value) {
                    $count += $value["qty"];
                }
            }
        }

        return new JsonResponse(array('status' => 'success', 'data' => $count));
    }

    /**
     * @Route("/cart/remove")
     * @Method({"POST"})
     */
    public function removeCart(Request $request)
    {
        $item_id = $request->get('item_id');
        $this->setCart($item_id, NULL, 1);

        $cart = $this->session->get('cart');
        return new JsonResponse(array('status' => 'success', 'data' => number_format($cart["gross_total"], 2)));
    }

    /**
     * @Route("/cart/update")
     * @Method({"POST"})
     */
    public function updateCart(Request $request)
    {
        $item_id = $request->get('item_id');
        $qty = $request->get('qty');

        $data = $this->setCart($item_id, $qty);

        return new JsonResponse(array('status' => 'success', 'data' => $data));
    }

    /**
     * @Route("/cart/add")
     * @Method({"POST"})
     */
    public function addToCart(Request $request)
    {
        $item_id = $request->get('item_id');
        $this->setCart($item_id);

        return new JsonResponse(array('status' => 'success'));
    }

    private function getDiscount($counts)
    {
        $discount = 0;
        //Children >= 5 books 10% discount
        if (isset($counts[1]['count']) && isset($counts[1]['total'])) {
            $children_book_count = $counts[1]['count'];
            $children_book_total = $counts[1]['total'];

            if ($children_book_count >= 5) {
                $discount += $children_book_total * 10 / 100;
            }

            //all >10 books 5% discount
            if (isset($counts[2]['count']) && isset($counts[2]['total'])) {
                $fiction_book_count = $counts[2]['count'];
                $fiction_book_total = $counts[2]['total'];
                if ($fiction_book_count >= 10 && $children_book_count >= 10) {
                    $discount += ($children_book_total + $fiction_book_total) * 5 / 100;
                }
            }
        }

        return $discount;
    }

    private function setCart($item, $qty = NULL, $remove = 0, $discount = NULL, $coupon_discount = NULL)
    {
        $cart_exists = $this->session->has('cart');
        if (!$cart_exists) {
            $this->initCart();
        }

        $cart = $this->session->get('cart');

        $new_items = [];
        $gross_total = 0;

        $item_found = false;
        $category_item_count = [];

        if (is_array($cart["items"])) {
            foreach ($cart["items"] as $key => $exist_item) {
                $temp_cat_item_qty = 0;
                $temp_cat_item_total = 0;

                if ($exist_item["id"] == $item) {

                    if ($remove != 1) {
                        $new_qty = (($qty == NULL) ? ($exist_item["qty"] + 1) : $qty);
                        $new_item_total = $exist_item["unit"] * $new_qty;

                        $new_items[] = $this->getItemTemplate($exist_item["id"], $exist_item["name"], $exist_item["isbn"], $exist_item["category"], $new_qty, $exist_item["unit"], $new_item_total);

                        $gross_total += $new_item_total;
                        $item_found = true;

                        if ($qty) {
                            $updated_item_total = $new_item_total;
                        }

                        $temp_cat_item_qty = $new_qty;
                    }
                } else {
                    $new_items[] = $exist_item;
                    $gross_total += $exist_item["total"];

                    // if (isset($category_item_count[$exist_item["category"]])) {
                    //     $category_item_count[$exist_item["category"]] += $exist_item["qty"];
                    // } else {
                    //     $category_item_count[$exist_item["category"]] = $exist_item["qty"];
                    // }
                    $temp_cat_item_qty = $exist_item["qty"];
                }

                if ($temp_cat_item_qty != 0) {
                    if (isset($category_item_count[$exist_item["category"]]["count"])) {
                        $category_item_count[$exist_item["category"]]["count"] += $temp_cat_item_qty;
                    } else {
                        $category_item_count[$exist_item["category"]]["count"] = $temp_cat_item_qty;
                    }
                }

                if (isset($category_item_count[$exist_item["category"]]["total"])) {
                    $category_item_count[$exist_item["category"]]["total"] += $gross_total;
                } else {
                    $category_item_count[$exist_item["category"]]["total"] = $gross_total;
                }
            }
        }
        if (!$item_found && !$qty && $remove != 1) {

            $book = $this->getDoctrine()->getRepository(Book::class)->find($item);

            if ($book) {
                $new_qty = (($qty == NULL) ? 1 : $qty);
                $new_total = $book->getPrice() * $new_qty;

                $new_items[] = $this->getItemTemplate($book->getId(), $book->getName(), $book->getIsbn(), $book->getCategory()->getId(), $new_qty, $book->getPrice(), $new_total);

                $gross_total += $new_total;
            }
        }



        // $new_discount = ($discount) ? $discount + $cart['discount'] : $cart['discount'];
        $new_discount = $this->getDiscount($category_item_count);
        // $new_discount = $gross_total * $discount_rate / 100;
        $new_coupon_discount = ($coupon_discount) ? $coupon_discount + $cart['coupon_discount'] : $cart['coupon_discount'];
        $this->session->set('cart', [
            'gross_total' => $gross_total,
            'discount' => $new_discount,
            'coupon_discount' => $new_coupon_discount,
            'net_total' => $gross_total - $new_coupon_discount - $new_discount,
            'items' => $new_items
        ]);

        if ($qty) {
            return [
                'item_total' => number_format($updated_item_total, 2),
                'total' => number_format($gross_total, 2),
            ];
        }
    }

    private function getItemTemplate($id, $name, $isbn, $category, $qty, $unit, $total)
    {
        return [
            'id' => $id,
            'name' => $name,
            'isbn' => $isbn,
            'category' => $category,
            'qty' => $qty,
            'unit' => $unit,
            'total' => $total
        ];
    }

    public function initCart()
    {
        $this->session->set('cart', [
            'gross_total' => 0,
            'discount' => 0,
            'coupon_discount' => 0,
            'net_total' => 0,
            'items' => []
        ]);
    }

    /**
     *@Route("/article/save")
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('title');
        $article->setBody('this is the body');

        $entityManager->persist($article);

        $entityManager->flush();

        return new Response('saved');
    }
}

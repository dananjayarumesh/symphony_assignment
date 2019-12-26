<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     * @Method({"GET"})
     */
    public function index()
    {
        // $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('cart.html.twig');
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
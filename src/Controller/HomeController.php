<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function index()
    {

        // $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        
        

        // return new Response(
        //     '<html><body>Lucky number: 3</body></html>'
        // );

        return $this->render('home.html.twig');
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
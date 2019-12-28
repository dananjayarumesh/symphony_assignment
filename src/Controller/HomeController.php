<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Book;
use App\Entity\Category;
class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render('home.html.twig',array('books'=> $books,'categories'=>$categories));
    }

    /**
     * @Route("get-book-list")
     * @Method({"POST"})
     */
    public function getBookList(Request $request)
    {
        $cat_id = $request->get('cat_id');
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        if ($cat_id != 0) {
            $books = $bookRepository->findByCategory($cat_id);
        } else {
            $books = $bookRepository->getArrayResult();
        }
        // $books = $this->getDoctrine()->getRepository(Book::class)->getArrayResult();

        // dump($books);
        return $this->render('includes/book-list.html.twig',array('books'=> $books));
        // return new JsonResponse(array('data' => $books));
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
<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

    /**
     * @Route("/blog/page/{page_number}", name="blog")
     */
    public  function index1(Request $request, $page_number)
    {
        $repository=$this->getDoctrine()->getRepository(Article::class);
        $data=$repository->findall();
        return $this->render('main/index.html.twig', [
            'data'=>$data,
            'page_number'=>$page_number,
    ]);
    }
    /**
     * @Route("/blog/search", name="search")
     */
    public  function index2(Request $request)
    {
        return $this->render('main/search.html.twig', [

    ]);
    }
    /**
     * @Route("/blog/posts/{article_id}", name="post")
     */
    public  function index3(Request $request, $article_id)
    {
        $repository=$this->getDoctrine()->getRepository(Article::class);
        $result=$repository->findBy(['id'=>$article_id]);
        return $this->render('main/article.html.twig', [
            'result'=>$result,
        ]);
    }
}

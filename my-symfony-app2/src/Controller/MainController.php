<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MainController extends AbstractController
{
    /**
     * @Route("/blog/page/{page_number}", name = "blog")
     */
    public function index1(Request $request, $page_number)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findall();

        return $this->render('main/index.html.twig', [
            'data' => $data,
            'page_number' => $page_number,
            'result' => $data,
        ]);
    }

    /**
     * @Route("/blog/search", name = "search")
     */
    public function index2(Request $request)
    {
        return $this->render('main/search.html.twig', [

        ]);
    }

    /**
     * @Route("/blog/posts/{article_id}", name = "post")
     */
    public function index3(Request $request, $article_id)
    {
        $comment = new Comment;
        $form = $this->createFormBuilder()
            ->add('content', TextType::class)
            ->add('posted', DateTimeType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $comment = $form->getData();
            $form->handleRequest($request);
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect('http://127.0.0.1:8000');
        } else {
            $repository = $this->getDoctrine()->getRepository(Article::class);
            $result = $repository->findBy(['id' => $article_id]);
            return $this->render('main/article.html.twig', [
                'result' => $result,
            ]);
        }

    }

    /**
     * }* @Route("/blog/search/result", name = "search_result")
     */
    public function index4(Request $request)
    {
        $input = $request->request->get('search_article');
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $result = $repository->findByTitle($input);
        return $this->render('main/search_result.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/blog/add", name = "blog_add")
     */
    public function index5()
    {
        $article = new Article;
        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('date', TextType::class)
            ->add('author', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();


        return $this->render('main/blog_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/add", name = "blog_add")
     * @Method("post")
     */
    public function index6(Request $request)
    {
        $article = new Article;
        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('date', TextType::class)
            ->add('author', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $person = $form->getData();
            $form->handleRequest($request);
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirect('http://127.0.0.1:8000');
        } else {
            return $this->render('main/blog_add.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    }
}
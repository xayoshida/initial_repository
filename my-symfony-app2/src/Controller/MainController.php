<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $result = $repository->findBy(['id'=>$article_id]);
        $comment = new Comment;
        $comment->setArticle($result[0]);
        $form = $this->createFormBuilder($comment)
            ->add('content', TextareaType::class)
            ->add('posted')
            ->add('save', SubmitType::class, ['label'=>'コメントを投稿',])
            ->getForm();
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getRepository(Comment::class);
        $result2 = $repository2->findBy(['article'=>$result[0]]);
        //$result2 = $repository2->findBy(['id'=>'1']);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect('http://127.0.0.1:8000');
        } else {
            return $this->render('main/article.html.twig', [
                'result' => $result,
                //'comment' => $result[0],
                'comment' => $result2,
                'form' => $form->createView(),
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
    public function index5(Request $request)
    {
        $article = new Article;
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
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
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('input', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Click'])
            ->getForm();
        $form->handleRequest($request);
        $message = $form->get('input')->getData();


        return $this->render('comment/index.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/comment/submit", name="comment_submit")
     */
    public function index2(Request $request)
    {

    }
}

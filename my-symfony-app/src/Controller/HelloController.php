<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(Request $request)
    {   
        $name = $request->request->get('input');
        return $this->render('hello/index.html.twig', [
            'controller' => 'hellocontroller',
            'input'=>$name,
        ]);
    }
}


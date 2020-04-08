<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(Request $request)
    {
        $repository=$this->getDoctrine()->getRepository(Person::class);
        $data=$repository->findall();
        return $this->render('hello/index.html.twig', [
            'data'=>$data,
            'title'=>'Hello',
        ]);
    }
}

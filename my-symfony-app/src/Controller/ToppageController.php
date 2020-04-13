<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToppageController extends AbstractController
{
    /**
     * @Route("/", name="toppage")
     */
    public function indexAction(Request $request)
    {
        $information = '公演情報を追加しました。';

        return $this->render('toppage/index.html.twig', [
            'information' => $information,
        ]);
    }
}

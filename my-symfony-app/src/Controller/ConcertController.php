<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    /**
     * @Route("/concert", name="concert")
     */
    public function indexAction()
    {
        $concertList = [
            [
                'date' => '2015年5月3日',
                'time' => '14:00',
                'place' => '東京文化会館',
                'available' => false,
            ],
            [
                'date' => '2015年7月12日',
                'time' => '14:00',
                'place' => '鎌倉芸術館',
                'available' => true,
            ],
            [
                'date' => '2015年9月20日',
                'time' => '15:00',
                'place' => '横浜みなとみらいホール',
                'available' => true,
            ],
        ];

        return $this->render('concert/index.html.twig', [
            'concertList' => $concertList,
        ]);
    }
}

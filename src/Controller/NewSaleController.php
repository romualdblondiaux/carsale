<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewSaleController extends AbstractController
{
    /**
     * @Route("/new/sale", name="new_sale")
     */
    public function index(): Response
    {
        return $this->render('new_sale/index.html.twig', [
            'controller_name' => 'NewSaleController',
        ]);
    }
}

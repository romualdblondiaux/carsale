<?php

namespace App\Controller;

use App\Repository\SaleCarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProsaleController extends AbstractController
{
    /**
     * @Route("/ventes/pro", name="prosales_index")
     */
    public function index(SaleCarsRepository $repo): Response
    {
        $prosales = $repo->findBySeller('Proffesional');

        return $this->render('vente/prosale/index.html.twig', [
            'prosales' => $prosales,
        ]);
    }
}

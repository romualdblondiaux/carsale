<?php

namespace App\Controller;

use App\Repository\SaleCarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartsaleController extends AbstractController
{
    /**
     * @Route("/ventes/part", name="partsales_index")
     */
    public function index(SaleCarsRepository $repo): Response
    {
        $partsales = $repo->findBySeller('Particular');

        return $this->render('vente/partsale/index.html.twig', [
            'partsales' => $partsales,
        ]);
    }
}

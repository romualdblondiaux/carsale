<?php

namespace App\Controller;

use App\Entity\SaleCars;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * @Route("/Ventes/{id}", name="sale_info")
     *
     * @param [string] $slug
     * @return Response
     */
    public function show(SaleCars $salecars)
    {
        //$repo = $this->getDoctrine()->getRepository(salecars::class);
        //$salecars = $repo->findOneById($id);
        //dump($salecars);

        return $this->render('vente/detail/info.html.twig',[
            'salecars' => $salecars
        ]);

    }

}

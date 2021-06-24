<?php

namespace App\Controller;

use App\Entity\SaleCars;
use App\Repository\SaleCarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(SaleCarsRepository $repo): Response
    {
        $newpartsales = $repo->findByNewSeller('Particular');
        $newprosales = $repo->findByNewSeller('Proffesional');

        return $this->render('home.html.twig', [
            'newpartsales' => $newpartsales,
            'newprosales' => $newprosales,
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

<?php

namespace App\Controller;

use App\Entity\SaleCars;
use App\Form\AnnonceType;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSaleCarsController extends AbstractController
{
    /**
     * Permet d'afficher l'ensemble des annonces 
     * @Route("/admin/sale/{page<\d+>?1}", name="admin_sale_cars_index")
     */
    public function index($page, PaginationService $pagination): Response
    {
        $pagination->setEntityClass(SaleCars::class)
                ->setPage($page)
                ->setLimit(10)
                ->setRoute('admin_sale_cars_index');
                /* setRoute est optionnel */
       
        return $this->render('admin/sale_cars/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
    

    /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/admin/sale/{id}/edit", name="admin_sale_cars_edit")
     * 
     * @param SaleCars $ad
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(SaleCars $ad, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(AnnonceType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'annonce <strong>{$ad->getMarque()}</strong> a bien été modifiée"
            );
        }

        return $this->render("admin/sale_cars/edit.html.twig",[
            'ad' => $ad,
            'myForm' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer une annonce
     * @Route("/admin/sale/{id}/delete", name="admin_sale_cars_delete")
     *
     * @param SaleCars $ad
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(SaleCars $ad, EntityManagerInterface $manager){
       
            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getMarque()}</strong> a bien été supprimée"
            );
            $manager->remove($ad);
            $manager->flush();

        

        return $this->redirectToRoute('admin_sale_cars_index');

    }
}

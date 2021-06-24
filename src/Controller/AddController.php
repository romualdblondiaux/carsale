<?php

namespace App\Controller;

use App\Entity\SaleCars;
use App\Form\AnnonceType;
use App\Form\AnnonceEditType;
use App\Repository\SaleCarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    /**
     * @Route("/adds", name="adds_index")
     */
    public function index(SaleCarsRepository $repo): Response
    {
        $adds = $repo->findAll();

        return $this->render('add/index.html.twig', [
            'adds' => $adds,
        ]);
    }

    /**
     * Permet de créer une annonce
     * @Route("/adds/new", name="adds_new")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function create(EntityManagerInterface $manager, Request $request)
    {
        $add = new SaleCars();
   
        $form = $this->createForm(AnnonceType::class, $add);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            foreach($add->getImages() as $image){
                $image->setAd($add);
                $manager->persist($image);
            }
            // on ajoute l'auteur mais attention maintenant il y a un risque de bug si on n'est pas connecté (à corriger)
            $add->setIdUser($this->getUser());

            $manager->persist($add);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$add->getMarque()}</strong> a bien été enregistrée"
            );

            return $this->redirectToRoute('adds_show',[
                'id' => $add->getId()
            ]);

        }


        return $this->render('add/new.html.twig',[
            'myForm' => $form->createView()
        ]);
    }


    /**
     * Permet de modifier une annonce
     * @Route("/adds/{id}/edit", name="adds_edit")
     * @Security("(is_granted('ROLE_USER') and user === add.getIdUser()) or is_granted('ROLE_ADMIN')", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Add $add
     * @return Response
     */
    public function edit(Request $request, EntityManagerInterface $manager, SaleCars $add)
    {
        $form = $this->createForm(AnnonceEditType::class, $add);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            foreach($add->getImages() as $image){
                $image->setAdd($add);
                $manager->persist($image);
            }

            $manager->persist($add);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$add->getMarque()}</strong> a bien été modifiée"
            );

            return $this->redirectToRoute('adds_show',[
                'id' => $add->getId()
            ]);
        }        


        return $this->render("add/edit.html.twig",[
            "add" => $add,
            "myForm" => $form->createView()
        ]);

    }

    /**
     * Permet d'afficher une seule annonce
     * @Route("/adds/{id}", name="adds_show")
     *
     * @param [string] $slug
     * @return Response
     */
    public function show(SaleCars $add)
    {
        //$repo = $this->getDoctrine()->getRepository(Add::class);
        //$add = $repo->findOneBySlug($id);
        //dump($add);

        return $this->render('add/show.html.twig',[
            'add' => $add
        ]);

    }

    /**
     * Permet de supprimer une annonce
     * @Route("/adds/{id}/delete", name="adds_delete")
     * @Security("is_granted('ROLE_USER') and user === add.getIdUser()", message="Vous n'avez pas le droit d'accèder à cette ressource")
     * @param Add $add
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(SaleCars $add, EntityManagerInterface $manager)
    {
        $this->addFlash(
            'success',
            "L'annonce <strong>{$add->getMarque()}</strong> a bien été supprimée"
        );
        $manager->remove($add);
        $manager->flush();
        return $this->redirectToRoute("adds_index");
    }
}

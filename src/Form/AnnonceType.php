<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\SaleCars;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Marque', TextType::class, $this->getConfiguration('Marque du véhicule','Donnez la marque'))
            ->add('Modele', TextType::class, $this->getConfiguration('Modèle du véhicule','Donnez le modele'))
            ->add('Img', UrlType::class, $this->getConfiguration('URL de l\'image','Donnez l\'adresse de votre image'))
            ->add('km', IntegerType::class, $this->getConfiguration('Kilomètrage du véhicule','Donnez le kilomètrage réel'))
            ->add('Prix', IntegerType::class, $this->getConfiguration('Prix du véhicule','Donnez le prix de vente'))
            ->add('Proprietaire', IntegerType::class, $this->getConfiguration('Propriétaire','Donnez le nombre de propriétaire'))
            ->add('Cylindree', IntegerType::class, $this->getConfiguration('Cylindrée','Donnez la cylindrée'))
            ->add('Puissance', IntegerType::class, $this->getConfiguration('Puissance','Donnez le puissance CV'))
            ->add('Carburant', TextType::class, $this->getConfiguration('Carburant','Donnez le Type de carburant'))
            ->add('Annee', IntegerType::class, $this->getConfiguration('Année','Donnez l\'année de la 1er mise en circulation'))
            ->add('Transmission', TextType::class, $this->getConfiguration('Transmition','Donnez le type de transmission'))
            ->add('Description', TextareaType::class, $this->getConfiguration('Description du véhicule','Décrivez le véhicule : couleur, état général, ...'))
            ->add('Opt', TextareaType::class, $this->getConfiguration('Option(s) du véhicule','Donnez le(s) option(s) du véhicule'))
            ->add(
                'Images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true, 
                    'allow_delete' => true
                ]
                );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SaleCars::class,
        ]);
    }
}

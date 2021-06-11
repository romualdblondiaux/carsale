<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('LastName', TextType::class, $this->getConfiguration("Nom : "," Votre nom de famille..."))
            ->add('FirstName', TextType::class, $this->getConfiguration("Prénom : "," Votre prénom..."))
            ->add('Address', TextType::class, $this->getConfiguration("Rue : "," Votre rue..."))
            ->add('Number', TextType::class, $this->getConfiguration("Numero : "," Votre numero..."))
            ->add('Cp', TextType::class, $this->getConfiguration("Code Postal : "," Votre CP..."))
            ->add('City', TextType::class, $this->getConfiguration("Ville : "," Votre ville..."))
            ->add('Phone', TextType::class, $this->getConfiguration("Tél. : "," Votre numero..."))
            ->add('seller', TextType::class, $this->getConfiguration("Vendeur : "," Particular ou proffessional"))
            ->add('email', EmailType::class, $this->getConfiguration("Email : ","Votre adresse email..."))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe","Votre mot de passe"))
            ->add('passwordConfirm',PasswordType::class, $this->getConfiguration("Confirmation de mot de passe","Veuillez confirmer votre mot de"))
            ->add('picture', FileType::class, [
                'label' => "Avatar (jpg,png,gif)",
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

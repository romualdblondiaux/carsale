<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
   // gestion du hash de password
   private $encoder;

   public function __construct(UserPasswordEncoderInterface $encoder)
   {
       $this->encoder = $encoder;
   }

   public function load(ObjectManager $manager)
   {
       $faker = Factory::create('FR-fr');
     
       // gestion manuel utilisateur

       $admin = new User();
       $admin->setFirstName('Romuald')
           ->setLastName('Blondiaux')
           ->setEmail('romuald.blondiaux@gmail.com')
           ->setPassword($this->encoder->encodePassword($admin,'admin'))
           ->setRoles(['ROLE_ADMIN'])
           ->setPicture('')
           ->setSeller(['Prossesional']);
       $manager->persist($admin);

       // gestion des utilisateurs 
       
       $genres = ['male','femelle'];
       $sellers = ['proffesional','particular'];

       for($u=1; $u <= 10; $u++){
           $user = new User();
           $genre = $faker->randomElement($genres);

           $picture = 'https://randomuser.me/api/portraits/';
           $pictureId = $faker->numberBetween(1,99).'.jpg';
   
           $picture .= ($genre == 'male' ? 'men/' : 'women/').$pictureId;

           $hash = $this->encoder->encodePassword($user,'password');

           $user->setFirstName($faker->FirstName($genre))
               ->setLastName($faker->LastName())
               ->setEmail($faker->email())
               ->setPassword($hash)
               ->setSeller($faker->seller($sellers))
               ->setPicture('');

           $manager->persist($user);
             

       }

       $manager->flush();
   }

}

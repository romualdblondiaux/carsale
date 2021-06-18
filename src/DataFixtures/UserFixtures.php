<?php

namespace App\DataFixtures;

use App\Entity\SaleCars;
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
            ->setPicture('https://picsum.photos/25/25')
            ->setSeller('Proffesional')
            ->setAddress('Rue du Curé')
            ->setNumber('13')
            ->setCp('7850')
            ->setCity('Enghien')
            ->setPhone('+32488444045');

       $manager->persist($admin);

       // gestion des utilisateurs 
       $user = [];
       $sellers = ['Proffesional','Particular'];

       for($u=1; $u <= 10; $u++){
           $user = new User();
           $seller = $faker->randomElement(($sellers));

           $hash = $this->encoder->encodePassword($user,'password');

           $user->setFirstName($faker->FirstName())
               ->setLastName($faker->LastName())
               ->setEmail($faker->email())
               ->setPassword($hash)
               ->setSeller($seller)
               ->setPicture('https://picsum.photos/25/25')
               ->setAddress($faker->streetName())
               ->setNumber(rand(1,999))
               ->setCp(rand(1000,9999))
               ->setCity($faker->City())
               ->setPhone($faker->e164PhoneNumber());


           $manager->persist($user);
           $users[]= $user;
             

       }

       // gestion des voitures
       for($a = 1; $a <= 12; $a++){
        
        $salecar = new SaleCars();

        $brand = array('Abarth','Aiways','Alfa Romeo','Alpine','Artega','Aston Martin','Audi','Bentley','BMW','BMW Alpina','Cadillac','Caterham','Chevrolet','Chrysler','Citroën','Cupra','Dacia',
            'Daihatsu','Dodge','Donkervoort','DS','Ferrari','Fiat','Ford','Genesis','Honda','Hummer','Hyundai','Infiniti','Isuzu','Jaguar','Jeep','KIA','KTM','Lada','Lamborghini','Lancia','Land Rover','Lexus','Lotus','Lynk & Co','Maserati','Mazda','McLaren','Mercedes-Benz','MG','Mia Electric','MINI','Mitsubishi','Nissan','Opel','Peugeot','Polestar','Porsche','Renault','Rolls-Royce','Saab','Seat','Seres','Skoda','Smart','Ssangyong','Subaru','Suzuki','Tesla','Toyota','Volkswagen','Volvo');
        $vehicleBrand = $faker->randomElement($brand);

        $model = array('Ceed','Rio','E-soul','Ev6','Niro','Picanto','Proceed','Sorento','Soul','Sportage','Stinger','Stonic','Xceed');
        $vehicleModel = $faker->randomElement($model);


        $fuel = array('Diesel','Essence','Hybride','Electrique');
        $vehicleFuel = $faker->randomElement($fuel);

        $trans = array('Traction avant FWD','Propulsion arrière RWD','Traction intégrale 4WD','Transmission intégrale AWD');
        $vehicleTrans = $faker->randomElement($trans);
        
        $description = $faker->paragraph(2);

        $opt = '<p>'.join('</p><p>',$faker->paragraphs(1)).'</p>';

        $user = $users[rand(0,count($users)-1)];
        
        $salecar->setMarque($vehicleBrand)
            ->setModele($vehicleModel)
            ->setImg('https://picsum.photos/1000/350')
            ->setKm(rand(0,150000))
            ->setPrix(rand(10000,1000000))
            ->setProprietaire(rand(1,3))
            ->setCylindree(rand(2000,5300))
            ->setPuissance(rand(100,640))
            ->setCarburant($vehicleFuel)
            ->setAnnee(rand(2000,2021))
            ->setTransmission($vehicleTrans)
            ->setDescription($description)
            ->setOpt($opt)
            ->setIdUser($user);

        $manager->persist($salecar);

        
    }

       $manager->flush();
   }

}

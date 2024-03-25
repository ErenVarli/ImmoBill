<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;
use App\Entity\Bien;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $type1 = new Type();
        $type1->setNom("Maison");
        $manager->persist($type1);

        $type2 = new Type();
        $type2->setNom("Appartement");
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setNom("Studio");
        $manager->persist($type3);

        $type4 = new Type();
        $type4->setNom("Duplex");
        $manager->persist($type4);

        $typeRepository=$manager->getRepository(Bien::class);

        //Je recupère grace à findOneBy le produit dont le nom est 
        //Ce nom je le copie de la BD 
        $bien1=$typeRepository->findOneBy(["titre"=>"Appartement"]);
        //Mise à jour de la catégorie puis on persiste
        $bien1->setType($type2);
        $manager->persist($bien1);

        //faire pareil pour les autres produits
        $bien2=$typeRepository->findOneBy(["titre"=>"Maison"]);
        $bien2->setType($type1);
        $manager->persist($bien2);

      
        $bien3=$typeRepository->findOneBy(["titre"=>"Duplex"]);
        $bien3->setType($type4);
        $manager->persist($bien3);

        $manager->flush();

    }
}

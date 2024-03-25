<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Proprietaires;

class ProprioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $proprio1 = new Proprietaires();
        $proprio1->setNom("Dupont")
            ->setPrenom("Alice")
            ->setMail("alicedupont@mail.com")
            ->setTel("0650458565")
            ->setAdresse("3 Rue du Grand Berger");
        $manager->persist($proprio1);


        $proprio2 = new Proprietaires();
        $proprio2->setNom("Dupont")
            ->setPrenom("Pierre")
            ->setMail("pdupont@mail.com")
            ->setTel("0612345678")
            ->setAdresse("1 Rue des Fleurs");
        $manager->persist($proprio2);


        $proprio3 = new Proprietaires();
        $proprio3->setNom("Martin")
            ->setPrenom("Thomas")
            ->setMail("thomas.martin@mail.com")
            ->setTel("0645612389")
            ->setAdresse("7 Rue du Marche");
        $manager->persist($proprio3);

        $proprio4 = new Proprietaires();
        $proprio4->setNom("Durand")
            ->setPrenom("Chloe")
            ->setMail("chloe.durand@mail.com")
            ->setTel("0687945123")
            ->setAdresse("9 Rue du Parc");
        $manager->persist($proprio4);

        $proprio5 = new Proprietaires();
        $proprio5->setNom("Robert")
            ->setPrenom("Jean")
            ->setMail("jean.robert@mail.com")
            ->setTel("0654879123")
            ->setAdresse("11 Rue des Ecoles");
        $manager->persist($proprio5);

        $manager->flush();
    }
}

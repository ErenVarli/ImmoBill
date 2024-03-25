<?php

namespace App\DataFixtures;
use App\Entity\Bien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BienFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $produit1 = new Bien();
        $produit1->setTitre("Appartement")
            ->setDescription("un beau appartement vue sur la mer")
            ->setSurface(300)
            ->setPrix(1500000)
            ->setNbPiece(8)
            ->setNbChambre(3)
            ->setEtage(0)
            ->setRue('2 rue plage')
            ->setCp('64100')
            ->setVille('Bayonne')
            ->setImage("OIP.jfif");


        $manager->persist($produit1);

        $produit2 = new Bien();
        $produit2->setTitre("Maison")
            ->setDescription("une belle maison vue sur la mer")
            ->setSurface(500)
            ->setPrix(3000000)
            ->setNbPiece(15)
            ->setNbChambre(5)
            ->setEtage(1)
            ->setRue('2 rue canard')
            ->setCp('64100')
            ->setVille('Bayonne')
            ->setImage("maison.jpg");


        $manager->persist($produit2);

        $produit3 = new Bien();
        $produit3->setTitre("Duplex")
            ->setDescription("un beau duplex vue sur la mer")
            ->setSurface(350)
            ->setPrix(2000000)
            ->setNbPiece(9)
            ->setNbChambre(3)
            ->setEtage(1)
            ->setRue('2 rue sable')
            ->setCp('64100')
            ->setVille('Bayonne')
            ->setImage("duplex.jpg");

        $manager->persist($produit3);

        $manager->flush();
    }
}

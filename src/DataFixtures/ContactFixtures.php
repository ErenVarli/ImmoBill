<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setNom("quessette")
            ->setPrenom("Loïc")
            ->setEmail("1234@gmail.com")
            ->setSujet("projet")
            ->setMessage("J'ai fait envoie message");
        $manager->persist($contact);

        $manager->flush();
    }
}

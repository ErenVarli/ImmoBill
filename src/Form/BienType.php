<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Proprietaires;
use App\Entity\Type;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['label' => 'Titre du bien'])
            ->add('description', TextareaType::class, ['label' => 'Description du bien'])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'label' => 'Le type',
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaires::class,
                'label' => 'Le propriétaire associé',
            ])
            ->add('surface', IntegerType::class, ['label' => 'La surface'])
            ->add('prix', IntegerType::class, ['label' => 'Le prix'])
            ->add('nbPiece', IntegerType::class, ['label' => 'Le nombre de pièce'])
            ->add('nbChambre', IntegerType::class, ['label' => 'Le nombre de chambre'])
            ->add('etage', IntegerType::class, ['label' => "Le nombre d'étage (0 si il n'y en a pas)"])
            ->add('rue', TextType::class, ['label' => 'La rue'])
            ->add('cp', TextType::class, ['label' => 'Le code postal'])
            ->add('ville', TextType::class, ['label' => 'La ville'])
            ->add('imageFile', FileType::class, ['required' => false, 'label' => "L'image du bien"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}

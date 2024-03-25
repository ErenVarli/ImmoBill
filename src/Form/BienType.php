<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Proprietaires;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description', TextareaType::class)
            ->add('type', EntityType::class, [
                'class' => Type::class,
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaires::class,
            ])
            ->add('surface')
            ->add('prix')
            ->add('nbPiece')
            ->add('nbChambre')
            ->add('etage')
            ->add('rue')
            ->add('cp')
            ->add('ville')
            ->add('imageFile', FileType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}

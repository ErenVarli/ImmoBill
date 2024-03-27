<?php

namespace App\Form;

use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom', 'constraints' => [new Assert\Length(['max' => 100])]])
            ->add('prenom', TextType::class, ['label' => 'Prénom', 'constraints' => [new Assert\Length(['max' => 100])]])
            ->add('email', EmailType::class, ['label' => 'Email', 'constraints' => [new Assert\Email(), new Assert\NotBlank(), new Assert\Length(['max' => 255])]])
            ->add('sujet', TextType::class, ['label' => 'Sujet', 'constraints' => [new Assert\Length(['max' => 100])]])
            ->add('message', TextareaType::class, ['label' => 'Message']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

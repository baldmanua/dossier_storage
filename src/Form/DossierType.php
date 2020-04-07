<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, ['label' => 'Dossier Type'])
            ->add('firstName', TextType::class, ['label' => 'First Name'])
            ->add('secondName', TextType::class, ['label' => 'Last Name'])
            ->add('address', TextareaType::class, ['label' => 'Address'])
            ->add('cardNumber', TextType::class, ['label' => 'Card #'])
            ->add('cvv', TextType::class, ['label' => 'CVV Code'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}

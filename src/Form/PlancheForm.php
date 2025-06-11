<?php

namespace App\Form;

use App\Entity\Planche;
use App\Entity\Pochette;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlancheForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPlanche', null, [
                'label' => 'Nom de la planche',
                'attr' => [
                    'class' => 'form-control login-input',
                    'placeholder' => 'Entrez le nom de la planche'
                ]
            ])
            ->add('createur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Créateur',
                'attr' => [
                    'class' => 'form-select login-input'
                ]
            ])
            ->add('pochettes', EntityType::class, [
                'class' => Pochette::class,
                'choice_label' => 'nomPochette',
                'label' => 'Pochettes associées',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'pochettes-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planche::class,
        ]);
    }
}

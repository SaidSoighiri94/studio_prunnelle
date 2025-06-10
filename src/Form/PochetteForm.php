<?php

namespace App\Form;

use App\Entity\Planche;
use App\Entity\Pochette;
use App\Entity\PriseDeVue;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PochetteForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPochette')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('createur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('planches', EntityType::class, [
                'class' => Planche::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('priseDeVues', EntityType::class, [
                'class' => PriseDeVue::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pochette::class,
        ]);
    }
}

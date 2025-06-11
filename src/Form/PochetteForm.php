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
                'choice_label' => 'email',
                'label' => 'Créateur',
            ])
            ->add('planches', EntityType::class, [
                'class' => Planche::class,
                'choice_label' => 'nomPlanche',
                'label' => 'Planches associées',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('priseDeVues', EntityType::class, [
                'class' => PriseDeVue::class,
                'choice_label' => function(PriseDeVue $priseDeVue) {
                    return $priseDeVue->getEcole()->getNom() . ' - ' . $priseDeVue->getDatePriseVue()->format('d/m/Y');
                },
                'label' => 'Prises de vue',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
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

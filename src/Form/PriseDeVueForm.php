<?php

namespace App\Form;

use App\Entity\Ecole;
use App\Entity\Pochette;
use App\Entity\PriseDeVue;
use App\Entity\Theme;
use App\Entity\TypePriseVue;
use App\Entity\TypeVente;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriseDeVueForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datePriseVue', null, [
                'widget' => 'single_text',
            ])
            ->add('cratedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('nbEleve')
            ->add('nb_classe')
            ->add('prixEcole')
            ->add('prixParent')
            ->add('Commentaires')
            ->add('ecole', EntityType::class, [
                'class' => Ecole::class,
                'choice_label' => 'id',
            ])
            ->add('photographe', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('typeDePrise', EntityType::class, [
                'class' => TypePriseVue::class,
                'choice_label' => 'id',
            ])
            ->add('typeVente', EntityType::class, [
                'class' => TypeVente::class,
                'choice_label' => 'id',
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'id',
            ])
            ->add('pochette', EntityType::class, [
                'class' => Pochette::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PriseDeVue::class,
        ]);
    }
}

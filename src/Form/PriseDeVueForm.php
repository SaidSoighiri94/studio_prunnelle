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
                'label' => 'Date de la prise de vue',
                'attr' => [
                    'class' => 'form-control login-input',
                    'placeholder' => 'JJ/MM/AAAA'
                ]
            ])
            ->add('ecole', EntityType::class, [
                'class' => Ecole::class,
                'choice_label' => function(Ecole $ecole) {
                    return sprintf('%s (%s)', $ecole->getNom(), $ecole->getCode());
                },
                'placeholder' => 'Sélectionnez une école',
                'attr' => ['class' => 'form-select login-input'],
                'label' => 'École',
                'required' => true
            ])
            ->add('typeDePrise', EntityType::class, [
                'class' => TypePriseVue::class,
                'choice_label' => 'nomTypePrise',
                'placeholder' => 'Sélectionnez le type de prise de vue',
                'attr' => ['class' => 'form-select login-input'],
                'label' => 'Type de prise de vue',
                'required' => true
            ])
            ->add('typeVente', EntityType::class, [
                'class' => TypeVente::class,
                'choice_label' => 'nomTypeVente',
                'placeholder' => 'Sélectionnez le type de vente',
                'attr' => ['class' => 'form-select login-input'],
                'label' => 'Type de vente',
                'required' => true
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'nomTheme',
                'placeholder' => 'Sélectionnez un thème',
                'attr' => ['class' => 'form-select login-input'],
                'label' => 'Thème',
                'required' => true
            ])
            ->add('nbEleve', null, [
                'label' => 'Nombre d\'élèves',
                'attr' => [
                    'class' => 'form-control login-input',
                    'min' => 1
                ]
            ])
            ->add('nb_classe', null, [
                'label' => 'Nombre de classes',
                'attr' => [
                    'class' => 'form-control login-input',
                    'min' => 1
                ]
            ])
            ->add('prixEcole', null, [
                'label' => 'Prix école (€)',
                'attr' => [
                    'class' => 'form-control login-input',
                    'step' => '0.01',
                    'min' => 0
                ]
            ])
            ->add('prixParent', null, [
                'label' => 'Prix parent (€)',
                'attr' => [
                    'class' => 'form-control login-input',
                    'step' => '0.01',
                    'min' => 0
                ]
            ])
            ->add('Commentaires', null, [
                'label' => 'Commentaires',
                'required' => false,
                'attr' => [
                    'class' => 'form-control login-input',
                    'rows' => 3,
                    'placeholder' => 'Ajoutez des notes ou commentaires (optionnel)'
                ]
            ])
            ->add('pochette', EntityType::class, [
                'class' => Pochette::class,
                'choice_label' => 'nomPochette',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'pochette-select'
                ],
                'label' => 'Pochettes disponibles',
                'required' => false
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

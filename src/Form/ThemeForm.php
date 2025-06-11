<?php

namespace App\Form;

use App\Entity\Theme;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThemeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomTheme', null, [
                'label' => 'Nom du thème',
                'attr' => [
                    'placeholder' => 'Entrez le nom du thème'
                ]
            ])
            ->add('createur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Créateur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Theme::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\TypePriseVue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypePriseVueForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomTypePrise', null, [
                'label' => 'Type de prise de vue',
                'attr' => [
                    'class' => 'form-control login-input',
                    'placeholder' => 'Entrez le type de prise de vue'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypePriseVue::class,
        ]);
    }
}

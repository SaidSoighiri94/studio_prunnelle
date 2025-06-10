<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Ecole;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcoleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('genre')
            ->add('nom')
            ->add('tel')
            ->add('email')
            ->add('active', CheckboxType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'role' => 'switch'
                ],
                'row_attr' => [
                    'class' => 'form-switch custom-switch mb-3'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ]
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('adresse', EntityType::class, [
                'class' => Adresse::class,
                'choice_label' => function(Adresse $adresse) {
                    return sprintf('%s, %s %s, %s',
                        $adresse->getRue(),
                        $adresse->getCodePostale(),
                        $adresse->getVille(),
                        $adresse->getPays()
                    );
                },
                'placeholder' => 'Sélectionnez une adresse',
                'attr' => [
                    'class' => 'form-control login-input'
                ],
                'label' => 'Adresse',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ecole::class,
        ]);
    }
}

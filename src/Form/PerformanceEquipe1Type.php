<?php

namespace App\Form;

use App\Entity\PerformanceEquipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformanceEquipe1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('victoires')
            ->add('defaites')
            ->add('nuls')
            ->add('but_marque')
            ->add('but_encaisses')
            ->add('Equipe_Responsable')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PerformanceEquipe::class,
        ]);
    }
}

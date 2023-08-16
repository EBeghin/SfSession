<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Programme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('session', HiddenType::class)
            ->add('matiere', EntityType::class, [
                'label' => 'Matière',
                'class' => Matiere::class,
                'choice_label' => 'Denomination',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée en jours',
                'attr' => [
                    'min' => 1, 'max' => 50,
                    'class' => 'form-control'
                    ]
            ])
            // on ne rajoute pas un add submit, car il y en a déjà un dans le formulaire de base !
            // ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}

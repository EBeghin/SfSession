<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ajout du type de champ ainsi que des attributs en fonction du champ 
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('nombrePlaceMax', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Denomination', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            // pour la liste déroulante, il faut le type Entity
            // et un toString pour afficher ce que l'on désire dans la liste
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('stagiaires', EntityType::class, [
                'class' => Stagiaire::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                // 'choice_label' => function(Stagiaire $stagiaire){
                //     return $stagiaire;
                // },
                'multiple'=> true,
                // 'choice_label' => 'nom'
            ])
            // rajout du bouton Valider
             ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}

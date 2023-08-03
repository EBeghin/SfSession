<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
                'multiple'=> true,
            ])
            // intégration d'un formulaire dans un formulaire (sans être obligatoirement un autre formulaire !)
            // (collectionType (quand on a un ArrayCollection dans le construct d'une entité))
            // la collection attend l'élément qu'elle rentrera dans le form
            ->add('programmes', CollectionType::class,[
                'entry_type' => ProgrammeType::class,
                'prototype' => true,
                // on va autoriser l'ajout de nouveau élément dans session qui seront persister grace au cascade_persist sur l'élément
                // ça va activer un data prototype qui sera un attribut html qu'on pourra manipuler en JavaScript
                'allow_add' => true,
                'allow_delete' => true,
                // il est obligatoire car Session n'a pas de setProgramme mais c'est Programme qui contient setSession
                // c'est Programme qui est propriétaire de la relation 
                // pour éviter un mapping false, on est obligé de rajouter un by_reference
                'by_reference' => false,
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

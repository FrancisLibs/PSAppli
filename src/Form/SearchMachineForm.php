<?php

namespace App\Form;

use App\Entity\Workshop;
use App\Data\SearchMachine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchMachineForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('internalCode', TextType::class, [
                'label'     => false,
                'required'  => false,
                'attr'      => ['placeholder' => 'Code...']
            ])
            ->add('designation', TextType::class, [
                'label'     => false,
                'required'  => false,
                'attr'      => ['placeholder' => 'Désignation...']
            ])

            ->add('constructor', TextType::class, [
                'label'     => false,
                'required'  => false,
                'attr'      => ['placeholder' => 'Constructeur...']
            ])

            ->add('model', TextType::class, [
                'label'     => false,
                'required'  => false,
                'attr'      => ['placeholder' => 'Modèle...']
            ])

            ->add('workshop', EntityType::class, [
                'class'     => Workshop::class,
                'choice_label' => 'name',
                'label'     => false,
                'required'  => false,
                'placeholder' => 'Atelier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchMachine::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
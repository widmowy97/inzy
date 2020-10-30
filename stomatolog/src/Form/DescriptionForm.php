<?php

namespace App\Form;
use App\Entity\Description;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DescriptionForm extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
    $builder
        ->add('Content', null, [
            'label' => 'Opis wizyty',
        ])
        ->add('Dodaj', SubmitType::class)
    ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Description::class,
        ]);

    }

}
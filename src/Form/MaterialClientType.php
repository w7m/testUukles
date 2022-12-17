<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Material;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'firstName',
                'attr' => [
                    'class' => 'client-check'
                ]
            ])
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'client-check'
                ]
            ])
            ->add('Sauvgarder' ,SubmitType::class)
        ;
    }
}

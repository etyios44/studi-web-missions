<?php

namespace App\Form;

use App\Entity\Missions;
use App\Entity\Country;
use App\Entity\Agent;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TitleMission')
            ->add('DescriptionMission')
            ->add('NameCode')            
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'nationality'
            ])
            ->add('agent', EntityType::class, [
                'class' => Agent::class,
                'choice_label' => 'name'
            ])
            ->add('DateStartMission')
            ->add('DateEndMission')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}

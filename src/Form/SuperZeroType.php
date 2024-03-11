<?php

namespace App\Form;

use App\Entity\Gadget;
use App\Entity\Mission;
use App\Entity\SuperZero;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuperZeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('superZeroName')
            ->add('realName')
            ->add('superSkillName')
            ->add('superSkillDescription')
            ->add('weakness')
            ->add('power')
            ->add('missions', EntityType::class, [
                'class' => Mission::class,
'choice_label' => 'title',
'multiple' => true,
'required' => false,
            ])
            ->add('teams', EntityType::class, [
                'class' => Team::class,
'choice_label' => 'title',
'multiple' => true,
'required' => false,
            ])
            ->add('gadget', EntityType::class, [
                'class' => Gadget::class,
'choice_label' => 'name',
'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuperZero::class,
        ]);
    }
}

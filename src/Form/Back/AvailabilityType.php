<?php

namespace App\Form\Back;

use App\Entity\Back\Availability;
use App\Entity\Back\Pratictioner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AvailabilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reason')
            ->add('startTime',DateTimeType::class, [
                'date_widget' => 'single_text'
                ])
            ->add('endTime',DateTimeType::class, [
                'date_widget' => 'single_text'
                ])
            ->add('recurrence')
            ->add('recurrenceDays', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Semaine' => 'Semaine'
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('isWorkingHours')
            ->add('daysOfWeeks', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('backgroundColor',ColorType::class)
            ->add('textColor',ColorType::class)
            ->add('borderColor',ColorType::class)
            ->add('allDay')
            ->add('pratictioner', EntityType::class, [
                'class' => Pratictioner::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Availability::class,
        ]);
    }
}

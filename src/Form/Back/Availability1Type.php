<?php

namespace App\Form\Back;

use App\Entity\Back\Availability;
use App\Entity\Back\Pratictioner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Availability1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reason')
            ->add('startTime')
            ->add('endTime')
            ->add('recurrence')
            ->add('recurrenceDays')
            ->add('isWorkingHours')
            ->add('daysOfWeeks')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('backgroundColor')
            ->add('textColor')
            ->add('borderColor')
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

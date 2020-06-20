<?php

namespace App\Form;

use App\Entity\Booking;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Bookingdate',null, array( 'widget' => 'choice',
                                             'years' => range(date(2020), date('Y') + 4),

                  ))
            ->add('Bookingtime')
            ->add('Numberofseats',ChoiceType::class,['choices' => range(1,11,1)])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}

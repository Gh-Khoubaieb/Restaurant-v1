<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
class UserType extends AbstractType
{

    public function __construct()
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password',PasswordType::class, array('label' => 'Password'))
            ->add('birthdate',null, array(  'widget' => 'choice',
                                            'years' => range(date(1940), date('Y') - 18),

                                         )
                 )
            ->add('address')
            ->add('city')
            ->add('zipcode')
            ->add('country')
            ->add('phone')
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'transition_domain' => 'forms'
        ]);
    }
}

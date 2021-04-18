<?php

namespace App\Form;

use App\Entity\Celi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CeliType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la celi')
            ))
            ->add('longitude',null , array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'coordonne geographique')
            ))
            ->add('latitude', null, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'coordonnee geographique')
            ))
            ->add('localite', EntityType::class, array(
                'class'=>'App\Entity\Localite',
                'choice_label'=>'nom',
                'expanded'=>false,
                'multiple'=>false,

                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la localite')
            ))
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Celi::class,
        ]);
    }
}

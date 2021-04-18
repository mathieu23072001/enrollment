<?php

namespace App\Form;

use App\Entity\Localite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LocaliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la localite')
            ))
            ->add('ville', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'ville de la localite')
            ))
            ->add('prefecture', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la prefecture')
            ))
            ->add('region', ChoiceType::class, [
                'required'=>true,
                'choices'  => [
                    'region'=> null,
                    'savane' => 'savane',
                    'kara' => 'kara',
                    'centrale' => 'centrale',
                    'plateau' => 'plateau',
                    'maritime' => 'maritime',
                 
                  
                ],
                'attr'=>array('class'=>'form-control','placeholder'=>'region'),
            ])

            
            ->add('canton', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom du canton')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Localite::class,
        ]);
    }
}

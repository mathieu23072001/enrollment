<?php

namespace App\Form;

use App\Entity\CarteInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarteInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nomCarte', ChoiceType::class, array(
            'required'=>true,
            
            'choices'  => [
                'Moyen inscription'=> null,
                'Carte_Identite' => 'Carte_Identite',
                'Permis' => 'Permis',
                'Passeport' => 'Passport',
                'temoignage' => 'temoignage',
              
                
              
            ],
            'attr'=>array('class'=>'form-control','placeholder'=>'nom de la carte')
        ))

        ->add('numeroCarte', TextType::class, array(
            'required'=>true,
            'attr'=>array('class'=>'form-control','placeholder'=>'numero de la carte')
        ))

        
        ->add('dateCreation', DateType::class, array(
            'required'=>true,
            'widget'=> 'single_text',
            'label'=>'Date de creation',
            'attr'=>array('class'=>'form-control','placeholder'=>'date de creation')
        ))


        ->add('dateExpiration', DateType::class, array(
            'required'=>true,
            'widget'=> 'single_text',
            'label'=>'Date expiration',
            'attr'=>array('class'=>'form-control','placeholder'=>'date expiration')
        ))

        
            
            
            
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarteInscription::class,
        ]);
    }
}

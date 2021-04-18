<?php

namespace App\Form;

use App\Entity\Electeur;
use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Data\Provider\CurrencyDataProvider;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RechercheElecType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom electeur')
            ))
            ->add('prenom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'prenom electeur')
            ))
            
            

            ->add('dateNaissance', DateType::class, array(
                'required'=>true,
                'widget'=> 'single_text',
                'label'=>'Date',
                'attr'=>array('class'=>'form-control','placeholder'=>'date de naissance')
            ))


           

            ->add('adresse', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'adresse electeur')
            ))


            ->add('sexe', ChoiceType::class, [
                'required'=>true,
                'choices'  => [
                    'sexe'=> null,
                    'Masculin' => 'masculin',
                    'Feminin' => 'feminin',
                    
                   
                  
                ],
                'attr'=>array('class'=>'form-control','placeholder'=>'sexe'),
            ])

          

            
            
            /*->add('dateAjout', DateTime::class, array(
                'required'=>true,
                'attr'=>
            ))*/
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Electeur::class,
        ]);
    }
}

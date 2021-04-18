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
use Vich\UploaderBundle\Form\Type\VichImageType;

class ElecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('imageFile', VichImageType::class, array(
            'required'=>false,
            'attr'=>array('class'=>'dropify','placeholder'=>'choisissez une image')
            
        ))
            ->add('nom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom electeur')
            ))
            ->add('prenom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'prenom electeur')
            ))
            ->add('pere', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom du pere')
            ))
            ->add('mere', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la mere')
            ))

            ->add('dateNaissance', DateType::class, array(
                'required'=>true,
                'widget'=> 'single_text',
                'label'=>'Date de naissance',
                'attr'=>array('class'=>'form-control','placeholder'=>'date de naissance')
            ))

            ->add('lieuNaissance', TextType::class, array(
                'required'=>true,
               
                'attr'=>array('class'=>'form-control','placeholder'=>'lieu de naissance')
            ))

            ->add('profession', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom de la profession')
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

            ->add('piece', CarteInscriptionType::class)
            ->add('carteElec', CarteElecteurType::class)

           

            
            
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

<?php

namespace App\Form;

use App\Entity\Contentieux;
use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Intl\Data\Provider\CurrencyDataProvider;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class ContentieuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPlaignant', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom du plaignant')
            ))
            ->add('prenomPlaignant', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'prenom du plaignant')
            ))
            ->add('adressePlaignant', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'adresse du plaignant')
            ))
            ->add('professionPlaignant', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'profession du plaignant')
            ))

           
           

            

          

           
            


            ->add('descriptionPlainte', TextareaType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'saisissez la plainte')
            )) ;         


         
            
           
          


            
            /*->add('dateAjout', DateTime::class, array(
                'required'=>true,
                'attr'=>
            ))*/
           
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contentieux::class,
        ]);
    }
}

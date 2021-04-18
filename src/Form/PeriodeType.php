<?php

namespace App\Form;

use App\Entity\Periode;
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

class PeriodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

       
            
          

            ->add('dateDebut', DateType::class, array(
                'required'=>true,
                'widget'=> 'single_text',
                'label'=>'Date de debut',
                'attr'=>array('class'=>'form-control','placeholder'=>'date de debut')
            ))


            ->add('dateFin', DateType::class, array(
                'required'=>true,
                'widget'=> 'single_text',
                'label'=>'Date de fin',
                'attr'=>array('class'=>'form-control','placeholder'=>'date de fin')
            ))

           

         

           

          
            
            /*->add('dateAjout', DateTime::class, array(
                'required'=>true,
                'attr'=>
            ))*/
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Periode::class,
        ]);
    }
}

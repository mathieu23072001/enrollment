<?php

namespace App\Form;

use App\Entity\OperateurSaisi;
use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Data\Provider\CurrencyDataProvider;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class OperateurSaisiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom operateur')
            ))
            ->add('prenom', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'prenom operateur')
            ))
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Masculin' => 'masculin',
                    'Feminin' => 'feminin',
                  
                ],
                'attr'=>array('class'=>'form-control','placeholder'=>'sexe')
            ])

            ->add('user', UserType::class)
           
            ->add('crv', EntityType::class, array(
                'class'=>'App\Entity\Crv',
                'choice_label'=>'nom',
                'expanded'=>false,
                'multiple'=>false,

                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom du bureaux de vote')
            ))

            ->add('username', TextType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nom d utilisateur')
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
            'data_class' => OperateurSaisi::class,
        ]);
    }
}

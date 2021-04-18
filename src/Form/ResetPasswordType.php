<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ChangePassword;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ResetPasswordType extends AbstractType {
 
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('oldPassword', PasswordType::class, array(
            'required'=>true,
            'attr'=>array('class'=>'form-control','placeholder'=>'ancien mot de passe')
            ))


            ->add('password', PasswordType::class, array(
                'required'=>true,
                'attr'=>array('class'=>'form-control','placeholder'=>'nouveau mot de passe')
                ))  
 
        ;
    }
 
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            //mettre le nouveau formulaire
            'data_class' => ChangePassword::class,
            'csrf_token_id' => 'change_password',
        ));
    }
 
}
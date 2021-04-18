<?php

namespace App\Controller\OperateurSaisi;

use App\Entity\OperateurSaisi;
use App\Entity\ChangePassword;
use App\Form\OperateurSaisiType;
use App\Form\ResetPasswordType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/operateur")
 * 
 */

class OperateurController extends AbstractController
{
    /**
     * @Route("/modif/{id}", name="app_operat_modif")
     */
    public function modif(Request $request, OperateurSaisi $operat, $id)
    {
        $form = $this->createForm(OperateurSaisiType::class, $operat);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($operat);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_operatList_index");
        }

        return $this->render('page/operatSaisi/edit.html.twig', ['form' => $form->createView()]);
        
    }

    /**
     * @Route("/edit", name="app_Operat_edit",methods={"GET","POST"})
     */
    public function edit(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $operat = new OperateurSaisi();
         
        $form = $this->createForm(OperateurSaisiType::class, $operat);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            
    
        
            $hash= $encoder->encodePassword($operat->getUser(), $operat->getUser()->getPassword());
            $operat->getUser()->setPassword($hash);
            $operat->getUser()->setRoles(["ROLE_USER"]);
            $em->persist($operat);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_operatList_index");
        }

        return $this->render('page/operatSaisi/edit.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/list", name="app_operatList_index")
     */
    public function list()
    {
        //on appelle la liste des operateurs de saisis
        $operats= $this->getDoctrine()->getRepository(OperateurSaisi::class)->findAll();
        
        
        return $this->render('page/operatSaisi/operatList.html.twig',[
            'operats'=> $operats
        ]);
    }

   


    /**
     * @Route("/suppr/{id}", name="app_operat_suppr")
     */
    public function suppr(Request $request, OperateurSaisi $operat, $id)
    {
        $form = $this->createForm(OperateurSaisiType::class, $operat);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($operat);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_operatList_index");
        }

        return $this->render('page/operatSaisi/edit.html.twig', ['form' => $form->createView()]);
        
    }


 /**
     * @Route("/modifier-mot-de-passe", name="reset-password")
     */
    public function reset(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $changePassword = new ChangePassword();
        // rattachement du formulaire avec la class changePassword
        $form = $this->createForm(ResetPasswordType::class, $changePassword);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
            $newpwd = $form->get('password')->getData();
 
            $newEncodedPassword = $passwordEncoder->encodePassword($user, $newpwd);
            $user->setPassword($newEncodedPassword);
 
            $em->flush();
            $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
 
            return $this->redirectToRoute('message-reset-password');
        }
 
        return $this->render('page/operatSaisi/password.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user
        ));
    }
 
/**
     * @Route("/message", name="message-reset-password")
     */

     public function message(){

        $user = $this->getUser();
        return $this->render('page/operatSaisi/message.html.twig',[
            'user'=> $user
        ]);
     }
}

      


<?php

namespace App\Controller\Periode;

use App\Entity\Periode;
use App\Form\PeriodeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/periode")
 * 
 */

class PeriodeController extends AbstractController
{
    /**
     * @Route("/edit/", name="app_periode_edit")
     */
    public function edit(Request $request,FlashyNotifier  $flashy): Response
    {   $periode= new Periode();

        $periodes=[];
        
       
        
        
       
       
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            
           // $date_now = new \dateTime('now');
            //$interval1= ($dateFin->diff($dateDebut))->days;
            $dateD= $periode->getDateDebut();
            //$interval2= $date_now->diff($periode->getDateFin())->days;
            $dateF= $periode->getDateFin();
            
           // $interval= $periode->getDateFin()->diff($periode->getDateDebut())->days;
            
            for ($i=0; $i<100;$i++){
            $periodes= $this->getDoctrine()->getRepository(Periode::class)->find($i);
            if($periodes){

            $em->remove($periodes);
            $em->flush();
            }
          }
           
            if($dateF>$dateD ){
                $periode->setCount(1);
                $em->persist($periode);
                $em->flush();
                $flashy -> success ('Periode definie!' , 'http://your-awesome-link.com' );
                return $this->redirectToRoute("accueil");

            }
        
    
            else {
                $flashy -> success ('Date definie non valide!' , 'http://your-awesome-link.com' );
                return $this->redirectToRoute("app_periode_edit");

            }
                
            
           
        }
       

        return $this->render('page/periode/config.html.twig', ['form' => $form->createView()]);
    }

    

  
 
}
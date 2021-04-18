<?php

namespace App\Controller\Accueil;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Crv;
use App\Entity\Electeur;
use App\Entity\Contentieux;
use App\Entity\Log;
use App\Entity\Transfert;
use App\Entity\CarteElecteur;
use App\Entity\OperateurSaisi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MercurySeries\FlashyBundle\FlashyNotifier;
use App\Form\RechercheNumType;


/**
 * Controller used to manage blog contents in the backend.
 *
 * 
 * 
 */

  

class SupAdminAccueilController extends AbstractController
{
    
  
    /**
     * @Route("/",name="accueil")
     */
     public function index()
    {
        $nbre= 1;
        $electeurs= $this->getDoctrine()->getRepository(Electeur::class)->findBy(['rad' => $nbre ]);
        $transferts= $this->getDoctrine()->getRepository(Transfert::class)->findBy(['electeur' => $electeurs ]);
        $contentieux= $this->getDoctrine()->getRepository(Contentieux::class)->findBy(['electeur' => $electeurs ]);

            
        return $this->render('page/supAdmin/statistique.html.twig',[
            'electeurs'=> $electeurs,'transferts'=> $transferts,'contentieux'=> $contentieux
        ]);
            
        
       
    }
    /**
     * @Route("/electeur",name="operat")
     */

    public function dashboard()
    {

        return $this->render('page/operatSaisi/operat.html.twig');
    }



     /**
     * @Route("/crvElec/{id}",name="app_elec_crv")
     */
    public function elecbycrv($id,EntityManagerInterface $entityManager)
    {
       
        $this->entityManager = $entityManager;
    
        $crv = $this->entityManager->getRepository(Crv::class)->find($id);
        $electeurs = $this->getDoctrine()->getRepository(Electeur::class)->findBy(['crv'=>$crv]);
       
            
            return $this->render('page/electeur/list.html.twig',[
                'electeurs'=> $electeurs,'crv'=> $crv
            ]);
            
        
       
    }




    
     /**
     * @Route("/historique/{id}",name="app_operat_historique")
     */
    public function historique($id,Request $request, EntityManagerInterface $entityManager,FlashyNotifier  $flashy)
    {
        $carte = new CarteElecteur();
        $form = $this->createForm(RechercheNumType::class, $carte);
        $form->handleRequest($request);
       
        $this->entityManager = $entityManager;
        $carte = new CarteElecteur();
        
        $form = $this->createForm(RechercheNumType::class, $carte);
        $form->handleRequest($request);
        $cartes= [];
        
        $user= $this->getUser();
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);


        if ($form->isSubmitted() && $form->isValid()){
           // $electeur->setOperat($operat);
            $num= $carte->getNumeroCarte();
           
            if($num!="")

                $nums = $this->getDoctrine()->getRepository(CarteElecteur::class)->findOneby(['numeroCarte'=>$num]);
                
                if($nums){
                    $electeurs = $this->getDoctrine()->getRepository(Electeur::class)->findOneby(['carteElec'=>$nums]);;
                  // $flashy->success('Électeur Trouvé!','http://your-awesome-link.com');
                      
                   return $this->render('page/electeur/details.html.twig',[
                    'electeurs'=> $electeurs
                ]);

                }
                
                

                
            
            else {
                
                 return $this->redirectToRoute("accueil");
                 $flashy -> warning ('Électeur non trouvé.' , 'http://your-awesome-link.com' );
            }
            
            

           
        }








        $this->entityManager = $entityManager;
    
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->find($id);
        $users = $operat->getUser();
        $logs = $this->getDoctrine()->getRepository(Log::class)->findBy(['user'=>$users]);
       
            
            return $this->render('page/operatSaisi/historique.html.twig',[
                'operat'=> $operat,'logs'=> $logs,'form' => $form->createView()
            ]);
            
        
       
    }
     /**
     * @Route("/elecDetails/{id}", name="app_elec_details")
     */
    public function details($id,EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    
        $electeurs = $this->entityManager->getRepository(Electeur::class)->find($id);
       
        
        //on appelle la liste des electeurs
        
       
        return $this->render('page/electeur/details.html.twig',[
            'electeurs'=> $electeurs
        ]);
    }
       
    


     /**
     * @Route("/rechercherNum", name="app_numero_recherche")
     */
    public function rechercherNum(Request $request, EntityManagerInterface $entityManager,FlashyNotifier  $flashy)
    {
        $this->entityManager = $entityManager;
        $carte = new CarteElecteur();
        
        $form = $this->createForm(RechercheNumType::class, $carte);
        $form->handleRequest($request);
        $cartes= [];
        
        $user= $this->getUser();
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);


        if ($form->isSubmitted() && $form->isValid()){
           // $electeur->setOperat($operat);
            $num= $carte->getNumeroCarte();
           
            if($num!="")

                $nums = $this->getDoctrine()->getRepository(CarteElecteur::class)->findOneby(['numeroCarte'=>$num]);
                 $transfert = $this->getDoctrine()->getRepository(Transfert::class)->findAll();
                if($nums){
                    $electeurs = $this->getDoctrine()->getRepository(Electeur::class)->findOneby(['carteElec'=>$nums]);;
                  // $flashy->success('Électeur Trouvé!','http://your-awesome-link.com');
                      
                   return $this->render('page/electeur/details.html.twig',[
                    'electeurs'=> $electeurs
                ]);

                }
                
                

                
            
            else {
                $flashy -> warning ('Électeur non trouvé.Enregistré!' , 'http://your-awesome-link.com' );
                 return $this->redirectToRoute("accueil");
            }
            
            

           
        }

        return $this->render('page/electeur/historique.html.twig', ['form' => $form->createView()]);
    }    



 /**
     * @Route("/gestionContentieux", name="app_contGestion_index")
     */
    public function contentieuxGestion()
    {
        //on appelle la liste des operateurs de saisis
        $contentieux= $this->getDoctrine()->getRepository(Contentieux::class)->findAll();
        
        
        return $this->render('page/electeur/contentieuxGestion.html.twig',[
            'contentieux'=> $contentieux
        ]);
    }



    /**
     * @Route("/radiation/{id}", name="app_radiation_index")
     */
    public function radiation($id,EntityManagerInterface $entityManager)
    {
        $em = $this->getDoctrine()->getManager();
        $this->entityManager = $entityManager;
        
        $elec = $this->entityManager->getRepository(Electeur::class)->find($id);
        $electeur= $elec->setRad(0);
        $em->persist($electeur);
        $em->flush();

       
        
       //$contentieux= $this->getDoctrine()->getRepository(Contentieux::class)->findAll(); 
        
        return $this->redirectToRoute("app_contGestion_index");
    }

    /**
     * @Route("/elecTotal", name="app_elecTotal_index")
     */
    public function elecTotal()
    {
        //on appelle la liste des operateurs de saisis
        
        $electeurs= $this->getDoctrine()->getRepository(Electeur::class)->findAll();
        
        
        return $this->render('page/electeur/electeurTotal.html.twig',[
            'electeurs'=> $electeurs
        ]);
    } 


    /**
     * @Route("/transfertTotal", name="app_transfertTotal_index")
     */
    public function transfertTotal()
    {
        //on appelle la liste des operateurs de saisis
        
        $transferts= $this->getDoctrine()->getRepository(Transfert::class)->findAll();
        
        
        return $this->render('page/electeur/transfertTotal.html.twig',[
            'transferts'=> $transferts
        ]);
    } 


     
    
}

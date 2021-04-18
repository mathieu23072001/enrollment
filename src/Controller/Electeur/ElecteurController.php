<?php

namespace App\Controller\Electeur;
use App\Entity\OperateurSaisi;
use App\Entity\Electeur;
use App\Entity\Log;
use App\Entity\Sequence;
use App\Entity\Modification;
use App\Entity\CarteElecteur;
use App\Entity\Transfert;
use App\Entity\Contentieux;
use App\Form\ElecteurType;
use App\Form\TransfertType;
use App\Form\CarteElecteurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\OperateurSaisiRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RechercheElecType;
use App\Form\ContentieuxType;
use App\Repository\ElecteurRepository;
use App\Repository\SequenceRepository;
use App\Repository\CarteElecteurRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
/**
 * @Route("/electeur")
 */
class ElecteurController extends AbstractController
{
    /**
     * @Route("/rechercher", name="app_electeur_recherche")
     */
    public function recherche(Request $request, EntityManagerInterface $entityManager,FlashyNotifier  $flashy)
    {
        $this->entityManager = $entityManager;
        $electeur = new Electeur();
        $transfert = new Transfert();
        $form = $this->createForm(RechercheElecType::class, $electeur);
        $form->handleRequest($request);
        $electeurs= [];
        
        $user= $this->getUser();
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);


        if ($form->isSubmitted() && $form->isValid()){
           // $electeur->setOperat($operat);
            $nom= $electeur->getNom();
            $prenom= $electeur->getPrenom();
            $date= $electeur->getDateNaissance();
            $adresse= $electeur->getAdresse();
            $sexe= $electeur->getSexe();

            if($nom!="" && $prenom!="" && $date!="" && $adresse!="" && $sexe!="")

                $electeurs = $this->getDoctrine()->getRepository(Electeur::class)->findBy(['nom'=>$nom,'prenom'=>$prenom,'dateNaissance'=>$date,'adresse'=>$adresse,'sexe'=>$sexe]);
                 $transfert = $this->getDoctrine()->getRepository(Transfert::class)->findAll();
                if($electeurs){
                   // $electeurs = $this->getDoctrine()->getRepository(Electeur::class)->findAll();
                   $flashy->success('Électeur Trouvé!','http://your-awesome-link.com');
                      
                    return $this->render('page/electeur/recherche.html.twig', ['form' => $form->createView(),'electeurs'=> $electeurs,'user'=> $user]);

                }
                
                

                
            
            else {
                $flashy -> warning ('Électeur non trouvé.Enregistré!' , 'http://your-awesome-link.com' );
                 return $this->redirectToRoute("app_electeur_edit", ['form' => $form->createView(),'nom'=> $nom,'prenom'=> $prenom,'adresse'=> $adresse,'sexe'=> $sexe]);
                // return $this->render('page/electeur/edit.html.twig', ['form' => $form->createView(),'nom'=> $nom,'prenom'=> $prenom]);
              //return $this->redirectToRoute("app_electeur_edit", ['form' => $form->createView($nom,$prenom),'nom'=> $nom,'prenom'=> $prenom]);
            }
            
            

           
        }

        return $this->render('page/electeur/recherche.html.twig', ['form' => $form->createView(),'electeurs'=> $electeurs,'user'=> $user]);
    }    
       
        
    
        
    

    /**
     * @Route("/edit/{nom}/{prenom}/{sexe}/{adresse}", name="app_electeur_edit",methods={"GET","POST"}, defaults={ "nom" = 0 ,"prenom"= 1,"adresse = 0","sexe" = 1 })
     */
    public function edit($nom,$prenom,$adresse,$sexe,Request $request ,EntityManagerInterface $entityManager,FlashyNotifier  $flashy,SequenceRepository $sequenceRepository): Response
    {
        $log = new Log();
        $user= $this->getUser();
        $events = $user->getOperateurSaisis();
        $em = $this->getDoctrine()->getManager();
        $electeur = new Electeur();
       
        $electeur->setNom($nom);
        $electeur->setPrenom($prenom);
        $electeur->setAdresse($adresse);
        $electeur->setSexe($sexe);
        
        $carte = new CarteElecteur();
        foreach($events as $e) {
            $region= $e->getCrv()->getCeli()->getLocalite()->getRegion();
           
        }
       
        //$var1 =$user->getOperateurSaisis()->getCrv()->getCeli()->getLocalite()->getRegion();
       
        
        $seq = $sequenceRepository->findOneBy(['libelle'=>'carte electeur']);
        if ($seq==null){
            $seqs = new Sequence();
            $reqs= $seqs->setLibelle("carte electeur");
            $em->persist($reqs);
            $em->flush();
            $seq=$reqs;
          
        }
//$count ="100-05-08-09-".($seq->getCount()+1);   
if($region=="maritime" ){
    $count ="mar-05-08-09-".($seq->getCount()+1);
}
if($region=="savane" ){
    $count ="sav-05-08-09-".($seq->getCount()+1);
}
if($region=="plateau" ){
    $count ="plat-05-08-09-".($seq->getCount()+1);
}
if($region=="kara" ){
    $count ="kara-05-08-09-".($seq->getCount()+1);
}
if($region=="centrale" ){
    $count ="centrale-05-08-09-".($seq->getCount()+1);
}
       
     
      // $electeur->getCarteElec()->setNumeroCarte($count);
       
            
       // $form = $this->createForm(CarteElecteurType::class, $carte);
       // $form->handleRequest($request);
            
        
        $form = $this->createForm(ElecteurType::class, $electeur);
       
        $form->handleRequest($request);

        //$em = $this->getDoctrine()->getManager();

       // $user= $this->getUser();
        $operat = $em->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);
        $dateControl = "2002-01-01 00:00:00";
        
       
        if ($form->isSubmitted() && $form->isValid()) {
            $log->setUser($user);
            $log->setLibelle("Enregistrement d'un electeur:".$count);
            $electeur->setRad(1);
            $electeur->setOperat($operat);
            $electeur->setCrv($operat->getCrv());
            $electeur->getCarteElec()->setNumeroCarte($count);
            $seq1 = $sequenceRepository->findOneBy(['libelle'=>'carte electeur']);
            if ($seq1==null){
                $seqs2 = new Sequence("carte electeur");
                $em->persist($seq1);
               
                $em->flush();
                $seq1=$seqs2;
            }
            $seq1->setCount($seq1->getCount()+1);
            
                
           // $electeur->setOperateur($operats);
            $em->persist($electeur);
            $em->persist($log);

            $em->flush();
            $flashy->success('Électeur enregistré!' , 'http://your-awesome-link.com' );
            return $this->redirectToRoute("app_electeur_carte");
        }

        return $this->render('page/electeur/edit.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/modif/{id}", name="app_electeur_modif")
     */
    public function modif(Request $request, Electeur $electeur, $id,FlashyNotifier  $flashy,EntityManagerInterface $entityManager)
    {
        $log = new Log();
        $this->entityManager = $entityManager;
        $user= $this->getUser();
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);
        $electeur = $this->entityManager->getRepository(Electeur::class)->find($id);
        $modification = new Modification();
        $form = $this->createForm(ElecteurType::class, $electeur);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
           
            $modification->setCrv($operat->getCrv()->getNom());
            $modification->setElecteur($electeur);
            $em->persist($electeur);
            $em->persist($modification);
            $log->setUser($user);
            $log->setLibelle("Modification d'un electeur:".$electeur->getCarteElec()->getNumeroCarte());
            $em->persist($log);
            $em->flush();
            $flashy -> success ('Électeur modifié!' , 'http://your-awesome-link.com' );
            return $this->redirectToRoute("app_electeurList_index");
        }

        return $this->render('page/electeur/edit.html.twig', ['form' => $form->createView()]);
    }


     /**
     * @Route("/contentieux/{id}", name="app_electeur_contentieux")
     */
    public function contentieux(Request $request ,EntityManagerInterface $entityManager, $id,FlashyNotifier  $flashy): Response
    {
        $this->entityManager = $entityManager;
        $contentieux = new Contentieux();
        $electeur = new Electeur();
        $log = new Log();
        
        
        
        $electeur = $this->entityManager->getRepository(Electeur::class)->find($id);
        
        
       
        
    
        $form = $this->createForm(ContentieuxType::class, $contentieux);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $user= $this->getUser();
        
        
     
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);

        
       
        if ($form->isSubmitted() && $form->isValid()) {
            $contentieux->setOperat($operat);
            $contentieux->setElecteur($electeur);
            $log->setUser($user);
            $log->setLibelle("Enregistrement d'un contentieux:".$electeur->getCarteElec()->getNumeroCarte());
        
          
            
                
           // $electeur->setOperateur($operats);
            $em->persist($contentieux);
            $em->persist($log);


            $em->flush();
            $flashy -> success ('Contentieux enregistré!' , 'http://your-awesome-link.com' );
            return $this->redirectToRoute("app_contentieuxList_index");
        }

        return $this->render('page/electeur/contentieux.html.twig', ['form' => $form->createView(),'electeurs'=> $electeur]);
    }

 /**
     * @Route("/transfert/{id}", name="app_electeur_transfert")
     */

    public function transfert(Request $request ,ElecteurRepository $electeurRepository, $id,FlashyNotifier  $flashy):Response
    {
        $em = $this->getDoctrine()->getManager();
        
        $transfert = new Transfert();
        $electeur = new Electeur();
        $log = new Log();
        $user= $this->getUser();
        
        
        
        $electeur = $electeurRepository->find($id);


        $form = $this->createForm(TransfertType::class, $transfert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $transfert->setElecteur($electeur);
            $electeur->setCrv($transfert->getCrv());
            
            $em->persist($transfert);
            $em->persist($electeur);
            $log->setUser($user);
            $log->setLibelle("Transfert d'un electeur:".$electeur->getCarteElec()->getNumeroCarte());
            $em->persist($log);
            $em->flush();
            $flashy -> success ('Transfert effectué!' , 'http://your-awesome-link.com' );
            return $this->redirectToRoute("app_electeurList_index");
        }

        return $this->render('page/electeur/transfert.html.twig', ['form' => $form->createView(),'electeurs'=> $electeur]);
    }
       
      

        /**
     * @Route("/carte/", name="app_electeur_carte")
     */
    public function carte()
    {
        $date_now = new \dateTime('now');
        
        $sequence = new Sequence();
        $sequence = $this->getDoctrine()->getRepository(Sequence::class)->find(1);
        $value = $sequence->getCount();
        
        //on appelle la liste des electeurs
        $electeurs= $this->getDoctrine()->getRepository(Electeur::class)->find($value);
       
        return $this->render('page/electeur/carte.html.twig',[
            'electeurs'=> $electeurs
        ]);
    }
        
     

      /**
     * @Route("/details/{id}", name="app_electeur_details")
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
     * @Route("/stat/",name="app_crv_stat")
     */

    public function stat(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $femme = "masculin";
        $homme = "feminin";
        $nbre= 1;
        $user= $this->getUser();
        $operat = $this->entityManager->getRepository(OperateurSaisi::class)->findOneBy(['user' => $user ]);
        $crvs = $operat->getCrv();
        $electeurs= $this->getDoctrine()->getRepository(Electeur::class)->findBy(['rad' => $nbre,'crv' => $crvs]);
        $elecF= $this->getDoctrine()->getRepository(Electeur::class)->findBy(['rad' => $nbre,'crv' => $crvs,'sexe' => $femme]);
        $elecH= $this->getDoctrine()->getRepository(Electeur::class)->findBy(['rad' => $nbre,'crv' => $crvs,'sexe' => $homme]);

        return $this->render('page/electeur/statistique.html.twig',[
            'electeurs'=> $electeurs,'elecF'=> $elecF,'elecH'=> $elecH
        ]);
    }
    
}

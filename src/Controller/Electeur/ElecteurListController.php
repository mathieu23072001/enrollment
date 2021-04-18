<?php

namespace App\Controller\Electeur;

use App\Entity\Contentieux;
use App\Entity\Electeur;
use App\Form\ElecteurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/electeurList")
 */
class ElecteurListController extends AbstractController
{
    /**
     * @Route("/contentieux", name="app_contentieuxList_index")
     */
    public function contList()
    {
        //on appelle la liste des operateurs de saisis
        $contentieux= $this->getDoctrine()->getRepository(Contentieux::class)->findAll();
        
        
        return $this->render('page/electeur/contentieuxList.html.twig',[
            'contentieux'=> $contentieux
        ]);
    }


     /**
     * @Route("/", name="app_electeurList_index")
     */
    public function index()
    {
        //on appelle la liste des operateurs de saisis
        $electeurs= $this->getDoctrine()->getRepository(Electeur::class)->findAll();
        $user = $this->getUser();
        
        return $this->render('page/electeur/electeurList.html.twig',[
            'electeurs'=> $electeurs, 'user'=> $user
        ]);
    }

   
    }


<?php

namespace App\Controller\Celi;

use App\Entity\Celi;
use App\Form\LocaliteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/celiList")
 * 
 */

class CeliListController extends AbstractController
{
    /**
     * @Route("/", name="app_celiList_index")
     */
    public function index()
    {
        //on appelle la liste des celis
        $celis= $this->getDoctrine()->getRepository(Celi::class)->findAll();
        
        
        return $this->render('page/celi/celiList.html.twig',[
            'celis'=> $celis
        ]);
    }

   
    }


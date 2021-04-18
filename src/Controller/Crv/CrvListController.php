<?php

namespace App\Controller\Crv;

use App\Entity\Crv;
use App\Form\CrvType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/crvList")
 * 
 */

class CrvListController extends AbstractController
{
    /**
     * @Route("/", name="app_crvList_index")
     */
    public function index()
    {
        //on appelle la liste des crv
        $crvs= $this->getDoctrine()->getRepository(Crv::class)->findAll();
        
        
        return $this->render('page/crv/crvList.html.twig',[
            'crvs'=> $crvs
        ]);
    }

   
    }


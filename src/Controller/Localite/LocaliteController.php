<?php

namespace App\Controller\Localite;

use App\Entity\Localite;
use App\Form\LocaliteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/localite")
 * 
 */

class LocaliteController extends AbstractController
{
    /**
     * @Route("/modif/{id}", name="app_localite_modif")
     */
    public function modif(Request $request, Localite $localite,$id)
    {
        $form = $this->createForm(LocaliteType::class, $localite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($localite);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_localiteListe_index");
        }

        return $this->render('page/localite/edit.html.twig', ['form' => $form->createView()]);
        
    }

    /**
     * @Route("/edit", name="app_localite_edit",methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $localite = new Localite();
        $form = $this->createForm(LocaliteType::class, $localite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($localite);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_localiteListe_index");
        }

        return $this->render('page/localite/edit.html.twig', ['form' => $form->createView()]);
    }


 /**
     * @Route("/suppr/{id}", name="app_localite_suppr")
     */
    public function suppr(Request $request, Localite $localite,$id)
    {
        $form = $this->createForm(LocaliteType::class, $localite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($localite);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_localiteListe_index");
        }

        return $this->render('page/localite/edit.html.twig', ['form' => $form->createView()]);
        
    }



}

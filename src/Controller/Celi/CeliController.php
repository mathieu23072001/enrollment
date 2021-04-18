<?php

namespace App\Controller\Celi;

use App\Entity\Celi;
use App\Form\CeliType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/celi")
 * 
 */

class CeliController extends AbstractController
{
    /**
     * @Route("/modif/{id}", name="app_celi_modif")
     */
    public function modif(Request $request, Celi $celi, $id)
    {
        $form = $this->createForm(CeliType::class, $celi);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($celi);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_celiList_index");
        }

        return $this->render('page/celi/edit.html.twig', ['form' => $form->createView()]);
    }
    

    /**
     * @Route("/edit", name="app_celi_edit",methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $celi = new Celi();
        $form = $this->createForm(CeliType::class, $celi);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($celi);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_celiList_index");
        }

        return $this->render('page/celi/edit.html.twig', ['form' => $form->createView()]);
    }

/**
     * @Route("/suppr/{id}", name="app_celi_suppr")
     */
    public function suppr(Request $request, Celi $celi, $id)
    {
        $form = $this->createForm(CeliType::class, $celi);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($celi);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_celiList_index");
        }

        return $this->render('page/celi/edit.html.twig', ['form' => $form->createView()]);
    }

}

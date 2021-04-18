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
 * @Route("/crv")
 * 
 */

class CrvController extends AbstractController
{
    /**
     * @Route("/modif/{id}", name="app_crv_modif")
     */
    public function modif(Request $request, Crv $crv, $id)
    {
        $form = $this->createForm(CrvType::class, $crv);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($crv);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_crvList_index");
        }

        return $this->render('page/crv/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit", name="app_crv_edit",methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $crv = new Crv();
        $form = $this->createForm(CrvType::class, $crv);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($crv);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_crvList_index");
        }

        return $this->render('page/crv/edit.html.twig', ['form' => $form->createView()]);
    }

 /**
     * @Route("/suppr/{id}", name="app_crv_suppr")
     */
    public function suppr(Request $request, Crv $crv, $id)
    {
        $form = $this->createForm(CrvType::class, $crv);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->remove($crv);
            $em->flush();
            $this->addFlash('success', 'enregistrement réussie');
            return $this->redirectToRoute("app_crvList_index");
        }

        return $this->render('page/crv/edit.html.twig', ['form' => $form->createView()]);
    }
}

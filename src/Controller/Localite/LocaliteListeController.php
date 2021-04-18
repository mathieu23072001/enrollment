<?php

namespace App\Controller\Localite;

use App\Entity\Localite;
use App\Form\LocaliteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Dompdf\Dompdf;
use Dompdf\Options;

use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Flex\Options as FlexOptions;

/**
 * Controller used to manage blog contents in the backend.
 *
 * @Route("/localiteListe")
 * 
 */

class LocaliteListeController extends AbstractController
{
    /**
     * @Route("/", name="app_localiteListe_index")
     */
    public function index()
    {
        //on appelle la liste des localites
        $localites= $this->getDoctrine()->getRepository(Localite::class)->findAll();
       
        return $this->render('page/localite/localiteListe.html.twig',[
            'localites'=> $localites
        ]);
    }


    /**
     * @Route("/imprimer", name="app_localiteListe_imprimer")
     */
    public function imprim()
    {
        //on appelle la liste des localites
       // Configure Dompdf according to your needs
       $pdfOptions = new Options();
       $pdfOptions->set('defaultFont', 'Arial');
       
       // Instantiate Dompdf with our options                'title' => "Welcome to our PDF Test"
       $dompdf = new Dompdf($pdfOptions);
       
       // Retrieve the HTML generated in our twig file
       $localites= $this->getDoctrine()->getRepository(Localite::class)->findAll();
       
       $html = $this->renderView('page/localite/localiteListe.html.twig',[
        'localites'=> $localites,'title' => "Liste des localités"
    ]);
       
       // Load HTML to Dompdf
       $dompdf->loadHtml($html);
       
       // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
       $dompdf->setPaper('A4', 'portrait');

       // Render the HTML as PDF
       $dompdf->render();

       // Output the generated PDF to Browser (force download)
       $dompdf->stream("mypdf.pdf", [
           "Attachment" => true
       ]);
    }


   
}


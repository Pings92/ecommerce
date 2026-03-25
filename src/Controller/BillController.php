<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BillController extends AbstractController
{   
    #[Route('/editor/order/{id}/bill', name: 'app_bill')]
    public function index(OrderRepository $orderRepository, $id): Response
    {
        
        $order = $orderRepository->find($id);
        $pdfOptions = new Options(); //nouvelle instanciation de options
        $pdfOptions->set('defaultFont','Arial');// defini la police utilisé
        $domPdf = new Dompdf($pdfOptions);//on ajoute les options défini au dessus
        $html = $this->renderView('bill/index.html.twig', [
        'order'=>$order,
        ]); // on insere ce qu'on veut imprimer
        $domPdf->loadHtml($html); //on charge 
        $domPdf->render();
        $output = $domPdf->output();
        // $domPdf->stream('bill-'.$order->getId().'.pdf',[
        //     'Attachement'=> false
        // ]);
         // on ajoute l'ext pdf, attfalse permet de choisir de voir ou imp la facture
        return new Response($output,200,[
            'Content-Type' =>'application/pdf',
            'Content-Disposition' => 'inline; filename="bill-' . $order->getId() . '.pdf"',
        ]);
    }
}


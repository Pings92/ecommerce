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
    // #[Route('/bill', name: 'app_bill')]
    // public function index(): Response
    // {
    //     return $this->render('bill/index.html.twig', [
    //         'controller_name' => 'BillController',
    //     ]);
    // }

    
    #[Route('/editor/order/{id}/bill', name: 'app_bill')]
    public function index(OrderRepository $orderRepository, $id): Response
    {
        
        $order = $orderRepository->find($id);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $domPdf = new Dompdf($pdfOptions);
        $html = $this->renderView('bill/index.html.twig', [
        'order'=>$order,
        ]);
        $domPdf->loadHtml($html);
        $domPdf->render();
        $domPdf->stream('bill-'.$order->getId().'.pdf',[
            'Attachement'=> false
        ]);
        return new Response('',200,[
            'Content-Type' =>'application/pdf'
        ]);
    }
}


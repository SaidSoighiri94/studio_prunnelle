<?php

namespace App\Controller;

use App\Entity\Ecole;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Twig\Environment;

final class ExportPdfController extends AbstractController
{
    #[Route('ecole/{id}/exportpdf', name: 'app_export_pdf_ecole')] 
    public function exportPdfEcole(Ecole $ecole, Pdf $knpSnappyPdf, Environment $twig): Response
    {
        // Render the HTML content for the PDF
        $html = $twig->render('export_pdf/ecole.html.twig', [
            'ecole' => $ecole,
        ]);

         $pdf = $knpSnappyPdf->getOutputFromHtml($html);

        // Generate the PDF from the HTML content
        return new PdfResponse ($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ecole_' . $ecole->getId() . '.pdf"'
        ]
        );

    }

    #[Route('/export/pdf', name: 'app_export_pdf')]
    public function index(): Response
    {
        return $this->render('export_pdf/index.html.twig', [
            'controller_name' => 'ExportPdfController',
            
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/generate', name: 'app_cover_letter_generate')]
    public function generate(): Response
    {
        return $this->render('cover_letter/index.html.twig', [
            'controller_name' => 'CoverLetterController',
        ]);
    }

    #[Route('/cover-letter/{id}', name: 'app_cover_letter_show')]
    public function show(): Response
    {
        return $this->render('cover_letter/index.html.twig', [
            'controller_name' => 'CoverLetterController',
        ]);
    }
    
}

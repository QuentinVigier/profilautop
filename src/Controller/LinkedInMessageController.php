<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LinkedInMessageController extends AbstractController
{
    #[Route('/linkedin-message/generate', name: 'app_linked_in_message_generate')]
    public function generate(): Response
    {
        return $this->render('linked_in_message/index.html.twig', [
            'controller_name' => 'LinkedInMessageController',
        ]);
    }

    #[Route('/linkedin-message/{id}', name: 'app_linked_in_message_show')]
    public function show(): Response
    {
        return $this->render('linked_in_message/index.html.twig', [
            'controller_name' => 'LinkedInMessageController',
        ]);
    }
}

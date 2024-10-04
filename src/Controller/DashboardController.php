<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'jobs' => $this->getUser()->getJobOffers(),
            'user' => $this->getUser(),
            'messages' => $this->getUser()->getLinkedInMessages(),
            'letters' => $this->getUser()->getCoverLetters(),
        ]);
    }
}

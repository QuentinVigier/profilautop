<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobOfferController extends AbstractController
{
    #[Route('/job/offers', name: 'app_job_offer')]
    public function list(): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }

    #[Route('/job/offer/new', name: 'app_job_offer_new')]
    public function new(): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }

    #[Route('/job/offers/{id}', name: 'app_job_offer_show')]
    public function show(): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }

    #[Route('/job/offers/{id}/edit', name: 'app_job_offer_edit')]
    public function edit(): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }

    #[Route('/job/offers/{id}/delete', name: 'app_job_offer_delete')]
    public function delete(): Response
    {
        return $this->render('job_offer/index.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }
}

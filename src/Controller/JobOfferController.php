<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobOfferController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/job/offers', name: 'app_job_offer')]
    public function list(): Response
    {
        // Récupérer toutes les offres d'emploi
        $jobOffers = $this->entityManager->getRepository(JobOffer::class)->findAll();

        return $this->render('job_offer/index.html.twig', [
            'jobs' => $this->getUser()->getJobOffers(),

        ]);
    }

    #[Route('/job/offer/new', name: 'app_job_offer_new')]
    public function new(): Response
    {
        // Ici, vous pourriez également passer un formulaire pour créer une nouvelle offre d'emploi
        return $this->render('job_offer/new.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }

    #[Route('/job/offers/{id}', name: 'app_job_offer_show')]
    public function show(int $id, JobOfferRepository $jr): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $jr->findOneBy(['id' => $id]);

        return $this->render('job_offer/show.html.twig', [
            'controller_name' => 'JobOfferController',
            'job_offer' => $jobOffer,
        ]);
    }

    #[Route('/job/offers/{id}/edit', name: 'app_job_offer_edit')]
    public function edit(int $id): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $this->entityManager->getRepository(JobOffer::class)->find($id);

        // Ici, vous pourriez également passer un formulaire pour éditer l'offre d'emploi
        return $this->render('job_offer/edit.html.twig', [
            'controller_name' => 'JobOfferController',
            'job_offer' => $jobOffer,
        ]);
    }

    #[Route('/job/offers/{id}/delete', name: 'app_job_offer_delete')]
    public function delete(int $id): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $this->entityManager->getRepository(JobOffer::class)->find($id);

        // Ici, vous pouvez ajouter la logique pour supprimer l'offre d'emploi

        return $this->render('job_offer/delete.html.twig', [
            'controller_name' => 'JobOfferController',
            'job_offer' => $jobOffer,
        ]);
    }
}
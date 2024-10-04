<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\NewJobOfferType;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
public function new(Request $request, EntityManagerInterface $em): Response
{
    $jobOffer = new JobOffer();
    $user = $this->getUser();
    $form = $this->createForm(NewJobOfferType::class, $jobOffer);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $jobOffer->setAppUser($user);
        
        $em->persist($jobOffer);
        $em->flush();

        return $this->redirectToRoute('app_job_offer', ['id' => $jobOffer->getId()]);
    }

    return $this->render('job_offer/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

    #[Route('/job/offers/{id}', name: 'app_job_offer_show')]
    public function show(int $id, JobOfferRepository $jr): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $jr->findOneBy(['id' => $id]);

        return $this->render('job_offer/show.html.twig', [
            'controller_name' => 'JobOfferController',
            'jobOffer' => $jobOffer,
        ]);
    }

    #[Route('/job/offers/{id}/edit', name: 'app_job_offer_edit')]
    public function edit(int $id, Request $request, JobOfferRepository $jobOfferRepository): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $jobOfferRepository->find($id);
    
        // Vérifier si l'offre d'emploi existe
        if (!$jobOffer) {
            throw $this->createNotFoundException('No job offer found for id '.$id);
        }
    
        // Créer le formulaire
        $form = $this->createForm(NewJobOfferType::class, $jobOffer);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin d'appeler persist() car l'entité est déjà gérée par Doctrine
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Job offer updated successfully.');
    
            // Rediriger vers la liste des offres d'emploi ou la page de détails
            return $this->redirectToRoute('app_job_offer');
        }
    
        return $this->render('job_offer/edit.html.twig', [
            'form' => $form->createView(),
            'job_offer' => $jobOffer,
        ]);
    }

    #[Route('/job/offers/{id}/delete', name: 'app_job_offer_delete')]
    public function delete(int $id, Request $request, ManagerRegistry $doctrine): Response
    {
        // Récupérer l'offre d'emploi par ID
        $jobOffer = $this->entityManager->getRepository(JobOffer::class)->find($id);

        if ($request->isMethod('POST')) {
            if ($this->isCsrfTokenValid('delete'.$jobOffer->getId(), $request->request->get('_token'))) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($jobOffer);
                $entityManager->flush();
    
                $this->addFlash('success', 'Job offer deleted successfully.');
    
                return $this->redirectToRoute('app_job_offer');
            }
        }

        return $this->render('job_offer/delete.html.twig', [
            'controller_name' => 'JobOfferController',
            'job_offer' => $jobOffer,
        ]);
    }
}
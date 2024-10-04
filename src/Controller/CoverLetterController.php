<?php

namespace App\Controller;

use App\Entity\CoverLetter;
use App\Form\NewCoverLetterType;
use App\Service\GeminiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/generate', name: 'app_cover_letter_generate')]
    public function generate(Request $request, EntityManagerInterface $em, GeminiService $geminiService): Response
    {
        $letter = new CoverLetter();
        $user = $this->getUser();
        $form = $this->createForm(NewCoverLetterType::class, $letter);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $jobOffer = $form->get('jobOffer')->getData();
            $keySkills = $form->get('key-skills')->getData();
            $experience = $form->get('experiences')->getData();
            $description = $form->get('description')->getData();

            $prompt = "Générez une lettre de motivation pour postuler à l'offre d'emploi suivante : " . $jobOffer .
                ". VOici une description de l'offre et des missions " . $description . 
                ", de plus tu dois inclure mes expèriences passés en rapport avec l'offre : " . $experience .
                " ainsi que mes compétences clés pour cette offre : " . $keySkills;

            $get = $geminiService->generateCOntent($prompt);

            $letter->setAppUser($user);
            $letter->setContent($get);
            $letter->setJobOffer($jobOffer);

            $em->persist($letter);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('cover_letter/index.html.twig', [
            'form' =>$form->createView(),
        ]);
    }

    #[Route('/cover-letter/{id}', name: 'app_cover_letter_show')]
    public function show(CoverLetter $coverLetter): Response
    {
        return $this->render('cover_letter/show.html.twig', [
            'coverLetter' => $coverLetter,
        ]);
    }
    
}

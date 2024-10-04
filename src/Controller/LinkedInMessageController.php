<?php

namespace App\Controller;

use App\Entity\LinkedInMessage;
use App\Form\NewLinkedInMessageType;
use App\Service\GeminiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LinkedInMessageController extends AbstractController
{
    #[Route('/linkedin-message/generate', name: 'app_linked_in_message_generate')]
    public function generate(Request $request, EntityManagerInterface $em, GeminiService $geminiService): Response
    {
        $message = new LinkedInMessage();
        $user = $this->getUser();
        $form = $this->createForm(NewLinkedInMessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobOffer = $form->get('jobOffer')->getData();
            $keySkills = $form->get('key-skills')->getData();

            $prompt = "Générez un message LinkedIn pour postuler à l'offre d'emploi suivante : " . $jobOffer .
                " avec pour compétences clés : " . $keySkills;

            $get = $geminiService->generateContent($prompt);

            $message->setAppUser($user);
            $message->setContent($get);
            $message->setJobOffer($jobOffer);

            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('linked_in_message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/linkedin-message/{id}', name: 'app_linked_in_message_show')]
    public function show(LinkedInMessage $linkedInMessage): Response
    {
        return $this->render('linked_in_message/show.html.twig', [
            'message' => $linkedInMessage,
        ]);
    }
}

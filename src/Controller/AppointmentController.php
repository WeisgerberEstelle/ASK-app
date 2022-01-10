<?php

namespace App\Controller;

use App\Form\AppointementsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/appointment", name="appointment")
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AppointementsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre rendez-vous a bien été enregistré.');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('appointment/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

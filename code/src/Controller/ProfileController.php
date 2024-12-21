<?php

namespace App\Controller;

use App\Form\Type\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ProfileType::class, options: ['validation_groups' => ['edit_profile']]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // do some logic
            dump($form->getData());
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $form = $this->createForm(ProfileType::class, options: ['validation_groups' => ['Default', 'registration']]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // do some logic
            dump($form->getData());
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form,
        ]);
    }
}

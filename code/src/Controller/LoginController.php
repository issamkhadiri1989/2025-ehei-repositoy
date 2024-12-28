<?php

declare(strict_types=1);

namespace App\Controller;

use App\Validator\Constraint\PasswordConstraint;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        if ($session->has('current_user')) {
            return $this->redirectToRoute('app_default');
        }

        $builder = $this->createFormBuilder(options: [
            'block_name' => 'security_form',
            'label' => 'Connexion',
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                ],
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new PasswordConstraint(),
                    new NotBlank(),
                    new NotNull(),
                ],
            ])
        ;

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $session = $request->getSession();
            $session->set('current_user', $data['email']);

            return $this->redirectToRoute('app_default');
        }

        return $this->render('login/index.html.twig', [
            'login_form' => $form,
        ]);
    }
}

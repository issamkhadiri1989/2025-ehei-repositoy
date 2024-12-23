<?php

namespace App\Controller;

use App\Form\Type\CreditCardPaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(): Response
    {
        $checkoutForm = $this->createForm(CreditCardPaymentType::class);

        return $this->render('checkout/index.html.twig', [
            'checkout_form' => $checkoutForm,
        ]);
    }
}

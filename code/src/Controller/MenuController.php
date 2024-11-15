<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    public function userMenu(): Response
    {
        return $this->render('partials/_user_menu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}

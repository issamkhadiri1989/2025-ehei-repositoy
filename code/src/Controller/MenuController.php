<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    public function userMenu(): Response
    {
        return $this->render('partials/_user_menu.html.twig', [
            'user_name' => 'Issam KHADIRI',
        ]);
    }
}

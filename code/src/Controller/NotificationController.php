<?php

declare(strict_types=1);

namespace App\Controller;

use App\Notification\Handler\NotificationHandlerInterface;
//use App\Notification\Handler\SMSRequestHandler;
use App\Notification\Handler\WhatsAppRequestHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NotificationController extends AbstractController
{
    public function __construct(
//        #[Autowire(service: SMSRequestHandler::class)]
        #[Autowire(service: WhatsAppRequestHandler::class)]
        private readonly NotificationHandlerInterface $handler,
    ) {

    }

    #[Route(name: "app_notification", path: "/send")]
    public function index(Request $request): Response
    {
        $this->handler->handle($request);

        return $this->render('notification/index.html.twig');
    }
}

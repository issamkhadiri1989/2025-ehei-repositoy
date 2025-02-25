<?php

declare(strict_types=1);

namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

final class Mailer
{
    public function __construct(
        private MailerInterface $mailer,
        #[Autowire(env: 'DEFAULT_ADMIN')] private string $from,
    ) {

    }

    public function send(Address $to, string $mailTemplate, array $contentVariables = []): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->from))
            ->to($to)
            ->htmlTemplate($mailTemplate)
            ->context($contentVariables);

        $this->mailer->send($email);
    }
}

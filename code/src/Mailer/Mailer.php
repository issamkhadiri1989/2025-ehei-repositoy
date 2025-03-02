<?php

declare(strict_types=1);

namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

final class Mailer
{
    public function __construct(private readonly MailerInterface $mailer)
    {

    }

    public function send(Address $from, Address $to, string $mailTemplate, array $contentVariables = []): void
    {
        $email = $this->buildMessage($from, $to, $mailTemplate, $contentVariables);

        $this->mailer->send($email);
    }

    public function sendWithAttachment(
        Address $from,
        Address $to,
        string $mailTemplate,
        array $files,
        array $contentVariables = [],
    ): void {
        $email = $this->buildMessage($from, $to, $mailTemplate, $contentVariables);

        foreach ($files as $file) {
            $email->addPart(new DataPart(new File($file)));
        }

        $this->mailer->send($email);
    }

    private function buildMessage(Address $from, Address $to, string $template, array $variables = []): Email
    {
        return (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->htmlTemplate($template)
            ->context($variables);
    }
}

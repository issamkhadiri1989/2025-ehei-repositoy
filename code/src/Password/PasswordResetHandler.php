<?php

declare(strict_types=1);

namespace App\Password;

use App\Employee\EmployeeAccountManager;
use App\Entity\Employee;
use App\Mailer\Mailer;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mime\Address;

final class PasswordResetHandler
{
    public function __construct(
        #[Autowire(service: PinCodeGenerator::class)]
        private readonly PinGeneratorInterface $generator,
        private readonly EmployeeAccountManager $manager,
        private readonly Mailer $mailer,
    ) {

    }

    public function reset(Employee $employee): void
    {
        $password = $this->generator->generate();

        $this->mailer->send(
            from: new Address('no-reply@ehei.com'),
            to: new Address($employee->getEmailAddress(), $employee->getFullName()),
            mailTemplate: 'email/generate_password.html.twig',
            contentVariables: [
                'password' => $password,
                'employee' => $employee,
            ],
        );

        $this->manager->lockEmployeeAccount($employee);
    }
}

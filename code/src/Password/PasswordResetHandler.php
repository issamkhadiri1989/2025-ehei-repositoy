<?php

declare(strict_types=1);

namespace App\Password;

use App\Employee\EmployeeManager;
use App\Entity\Employee;
use App\Mailer\Mailer;
use Symfony\Component\Mime\Address;

final class PasswordResetHandler
{
    public function __construct(
        private PasswordGenerator $generator,
        private EmployeeManager $manager,
        private Mailer $mailer,
    ) {

    }

    public function reset(Employee $employee): void
    {
        $password = $this->generator->generate();

        $this->mailer->send(
            new Address($employee->getEmailAddress(), $employee->getFullName()),
            'email/generate_password.html.twig',
            [
                'password' => $password,
                'employee' => $employee,
            ],
        );

        $this->manager->markEmployeeAsInitialized($employee);
    }
}

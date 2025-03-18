<?php

declare(strict_types=1);

namespace App\Password;

use App\Employee\EmployeeAccountManager;
use App\Entity\Employee;
use App\Mailer\Mailer;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Service\Attribute\Required;

final class PasswordResetHandler
{
    private LoggerInterface $logger;

    public function __construct(
        #[Autowire(service: PinCodeGenerator::class)]
        private readonly PinGeneratorInterface $generator,
        private readonly EmployeeAccountManager $manager,
        private readonly Mailer $mailer,
//        #[Autowire(param: 'app.administrator.default_email')]
        private readonly string $fromEmailAddress,
        private readonly ContainerBagInterface $containerBag,
//        #[Autowire(env: 'APP_ENV')]
//        private readonly string $environment,
//        private readonly array $emailSenderObject,
            private string $adminFullName,
    ) {

    }

    public function reset(Employee $employee): void
    {
        dump($this->adminFullName);
        $password = $this->generator->generate();

        $this->mailer->send(
            from: new Address($this->fromEmailAddress),
            to: new Address($employee->getEmailAddress(), $employee->getFullName()),
            mailTemplate: 'email/generate_password.html.twig',
            contentVariables: [
                'password' => $password,
                'employee' => $employee,
            ],
        );

        $this->manager->lockEmployeeAccount($employee);
//        if ('dev' === $this->environment) {
//            $this->logger->info('This i log', []);
//        }
    }

    #[Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}

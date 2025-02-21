<?php

declare(strict_types=1);

namespace App\Listener\Employee;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'sendConfirmationEmail', entity: Employee::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'performUpdate', entity: Employee::class)]
final class SendConfirmationListener
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function sendConfirmationEmail(Employee $employee, PrePersistEventArgs $event): void
    {
        // prepare the email to be sent
    }

    public function performUpdate(Employee $employee, PreUpdateEventArgs $event): void
    {
        // prepare the email to be sent
        $unitOfWork = $event->getObjectManager()->getUnitOfWork();

        $objet = $event->getObject(); // récupérer l'objet que nous sommes en train de modifier

        $changeSet = $event->getEntityChangeSet(); // récupérer la nouvelle et l'ancienne valeur

        // $changeSet = $unitOfWork->getEntityChangeSet($objet); <- on peut faire aussi comme ça pour récupérer la liste des changements
                                                                // la différence ici est que pour UnitOfWork, on récupère les changements de n'importe quel objet passé en argument tandis que pour $event->getEntityChangeSet()
                                                                // est lié uniquement pour l'objet en question (employé)

        // Enregistrer l'historique dans le fichier de journalisation, on peut le faire en base de données si besoin
        foreach ($changeSet as $column => $values) {
            // dump(\sprintf("Changement de `%s` de `%s` en `%s`", $column, $values[0], $values[1]));
            $this->logger->info(\sprintf("Changement de `%s` de `%s` en `%s`", $column, $values[0], $values[1]));
        }
    }
}

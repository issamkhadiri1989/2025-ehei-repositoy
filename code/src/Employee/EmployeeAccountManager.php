<?php

declare(strict_types=1);

namespace App\Employee;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

final class EmployeeAccountManager
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function lockEmployeeAccount(Employee $employee): void
    {
        $employee->setLocked(true);
        $this->manager->flush();
    }
}

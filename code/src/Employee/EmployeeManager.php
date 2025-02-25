<?php

declare(strict_types=1);

namespace App\Employee;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

final class EmployeeManager
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function markEmployeeAsInitialized(Employee $employee): void
    {
        $employee->setInitialized(true);
        $this->manager->flush();
    }
}

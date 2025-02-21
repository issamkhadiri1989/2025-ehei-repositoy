<?php

namespace App\Repository;

use App\Entity\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Department>
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Department::class);
    }

    public function getDepartmentsOrdered(): QueryBuilder
    {
//        $someCondition = ...

        return $this->createQueryBuilder('d')
//            ->where($someCondition)
            ->orderBy('d.name', 'ASC');
    }
}

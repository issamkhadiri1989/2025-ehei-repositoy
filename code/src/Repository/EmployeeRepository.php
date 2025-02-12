<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    //    /**
    //     * @return Employee[] Returns an array of Employee objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Employee
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function search(string $term = ''): array
    {
        // create the query builder object
        $queryBuilder = $this->createQueryBuilder('e');

        // only filter if the user sent something
        if ('' !== $term) {
            // using the expression, we can build complex queries
            $expression = $queryBuilder->expr();

            // we are searching in the employee's name, email address or identity code
            $condition = $expression->orX(
                $expression->like('e.fullName', ':fullName'),
                $expression->like('e.emailAddress', ':email'),
                $expression->like('e.identityCode', ':code'),
            );

            $queryBuilder->where($condition)
                ->setParameter(':fullName', '%' . $term . '%')
                ->setParameter(':email', '%' . $term . '%')
                ->setParameter(':code', '%' . $term . '%');
        }

        return $queryBuilder
            ->getQuery()
            ->getArrayResult();
    }
}

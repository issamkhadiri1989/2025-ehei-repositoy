<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function getPublishedBlogs(string $tag = ''): array
    {
        $builder = $this->createQueryBuilder('b')
            ->where('b.published = true')
            ->orderBy('b.id', 'DESC');

        if ('' !== $tag) {
            $builder->andWhere("JSON_CONTAINS(b.tags, :tag) = 1")
                ->setParameter('tag', \json_encode($tag));
        }

        return $builder
            ->getQuery()
            ->getResult();
    }

    public function saveBlog(Blog $instance, bool $shouldPersist = false): void
    {
        if (true === $shouldPersist) {
            $this->getEntityManager()->persist($instance);
        }

        $this->getEntityManager()->flush();
    }

    public function getDailyBlogs(): array
    {
        $manager = $this->getEntityManager();

        $today = new \DateTimeImmutable();

        $query = $manager->createQuery('
            SELECT   b
            FROM     App\Entity\Blog b
            WHERE    DATE(b.createdAt) = :date
            ORDER BY b.id desc
        ')->setParameter('date', $today->format('Y-m-d'));

        return $query->getResult();
    }

    public function getBlogs(): array
    {
        $queryBuilder = $this->createQueryBuilder('b');
        $today = new \DateTimeImmutable();

        $query = $queryBuilder->select('b')
            ->where('DATE(b.createdAt) = :date')
            ->setParameter('date', $today->format('Y-m-d'))
            ->orderBy('b.id', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function fetchBlogs(): array
    {
        $manager = $this->getEntityManager();

        $connection = $manager->getConnection();

        $date = new \DateTimeImmutable();

        $sql = "SELECT * FROM blog b WHERE DATE(b.created_at) = :date ORDER BY id DESC";

        $result = $connection->executeQuery($sql, ['date' => $date->format('Y-m-d')]);

        return $result->fetchAllAssociative();
    }

    public function getBlogsPublishedBetween(\DateTimeInterface $date1, \DateTimeInterface $date2): array
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $expr = $queryBuilder->expr();

        $condition = $expr->between('b.createdAt', ':day1', ':day2');

        $query = $queryBuilder->select('b')
            ->where($condition)
            ->setParameter('day1', $date1)
            ->setParameter('day2', $date2);

        return $query
            ->getQuery()
            ->getResult();
    }

    public function getBlogsPublishedOnly(\DateTimeInterface $date1, \DateTimeInterface $date2, User $author): array
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $expr = $queryBuilder->expr();

        $orCondition = $expr->orX($expr->eq('b.author', ':author'), $expr->eq('b.published', ':published'));

        $condition = $expr->andX($expr->between('b.createdAt', ':day1', ':day2'), $orCondition);

        $query = $queryBuilder
            ->where($condition)
            ->setParameter('author', $author)
            ->setParameter('published', true)
            ->setParameter('day1', $date1)
            ->setParameter('day2', $date2)
            ->getQuery();

        return $query->getResult();
    }

    public function getBlogWithIdentifier(int $id): ?Blog
    {
        $queryBuilder = $this->createQueryBuilder('b');

        return $queryBuilder->select('b')
            ->addSelect('a')
            ->innerJoin('b.author', 'a')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

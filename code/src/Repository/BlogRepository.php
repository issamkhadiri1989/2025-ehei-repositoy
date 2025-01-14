<?php

namespace App\Repository;

use App\Entity\Blog;
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

    public function addNewBlog(Blog $instance): void
    {
        $this->doSave($instance, true);
    }

    public function editBlog(Blog $instance): void
    {
        $this->doSave($instance, false);
    }

    public function removeBlog(Blog $blog): void
    {
        $manager = $this->getEntityManager();

        $manager->remove($blog);

        $this->doSave($blog, false);
    }

    private function doSave(Blog $blog, bool $mustPersist)
    {
        $manager = $this->getEntityManager();

        if (true === $mustPersist) {
            $manager->persist($blog);
        }

        $manager->flush();
    }
}

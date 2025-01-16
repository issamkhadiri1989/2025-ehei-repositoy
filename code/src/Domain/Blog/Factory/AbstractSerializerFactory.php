<?php

declare(strict_types=1);

namespace App\Domain\Blog\Factory;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractSerializerFactory extends AbstractFactory
{
    public function __construct(protected readonly SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }
}

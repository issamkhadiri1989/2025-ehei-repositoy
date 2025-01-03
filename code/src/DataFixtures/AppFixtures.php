<?php

namespace App\DataFixtures;

use App\Factory\BlogFactory;
use App\Factory\CategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(16);

        UserFactory::createMany(18);

        $tags = ['Doctrine', 'PHP', 'OOP', 'Symfony', 'Dev', 'Web', 'Twig'];

        BlogFactory::createMany(50, fn() => [
            'author' => UserFactory::random(),
            'categories' => CategoryFactory::randomSet(\rand(1, 8)),
            'tags' => $this->getRandomSubset($tags, 7),
        ]);

        $manager->flush();
    }

    private function getRandomSubset(array $set, int $count): array
    {
        $n = \rand(0, $count);

        if ($n <= 1) {
            return  [];
        }

        return \array_rand(\array_flip($set), $n);
    }
}

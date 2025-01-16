<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            ["name" => "Programmation et Développement", "description" => "Articles sur les différents langages de programmation, les frameworks et les techniques de codage."],
            ["name" => "Cyber Sécurité", "description" => "Conseils et informations sur la sécurité informatique, la protection des données et les dernières menaces en ligne."],
            ["name" => "Intelligence Artificielle et Machine Learning", "description" => "Explications, tutoriels et études de cas sur l'IA et le ML."],
            ["name" => "Réseaux et Télécommunications", "description" => "Informations sur la configuration des réseaux, les protocoles et les nouvelles technologies de communication."],
            ["name" => "Matériel et Gadgets", "description" => "Revues et comparatifs de matériels informatiques, ainsi que des nouveautés technologiques."],
            ["name" => "Logiciels et Applications", "description" => "Articles sur les logiciels utiles, les applications et les outils de productivité."],
            ["name" => "Tutoriels et Guides", "description" => "Étapes détaillées pour réaliser des projets ou résoudre des problèmes techniques."],
            ["name" => "Actualités et Tendances", "description" => "Les dernières nouvelles et tendances dans le monde de l'IT."],
            ["name" => "Expériences et Projets Personnels", "description" => "Partage d'expériences personnelles, de projets DIY et de succès professionnels."],
            ["name" => "Carrière en IT", "description" => "Conseils sur les carrières, les formations et les compétences requises dans le domaine de l'informatique."],
        ];

        foreach ($categories as $category) {
            $item = new Category();
            $item->setName($category['name'])
                ->setDescription($category['description']);

            $manager->persist($item);
        }

        $manager->flush();
    }
}

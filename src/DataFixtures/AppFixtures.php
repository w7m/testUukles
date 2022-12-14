<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Material;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1;$i<20;$i++) {
            $client = new Client();
            $client->setFirstName('jean ' . $i)
                ->setLastName('jack  '. $i)
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setEmail('jean' . $i . '.jack@jean.com');
            $material = new Material();
            $material->setClient($client)
                ->setPrice(10 + $i)
                ->setName('material ' . $i)
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setDescription('description material ' . $i);
            $manager->persist($client);
            $manager->persist($material);
        }

        $client = new Client();
        $client->setFirstName('pierre')
            ->setLastName('marceau')
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setEmail('.pierre@marceau.com');
        $manager->persist($client);
        $this->loadMaterial($manager, $client,2800);

        $client = new Client();
        $client->setFirstName('hugo')
            ->setLastName('pierre')
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setEmail('.hugo@hugo.com');
        $manager->persist($client);
        $this->loadMaterial($manager, $client, 3000);

        $manager->flush();
    }


    private function loadMaterial(ObjectManager $manager, Client $client, int $sum) : void
    {
        for ($i=1;$i<35;$i++) {
            $material = new Material();
            $material->setClient($client)
                ->setPrice($sum + $i)
                ->setName('material ' . $i)
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setDescription('description material ' . $i);
            $manager->persist($material);
        }
    }
}

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
            $material->setPrice(10 + $i)
                ->setName('material ' . $i)
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setDescription('description material ' . $i);
            $client->addMaterial($material);
            $manager->persist($client);
            $manager->persist($material);
        }

        $client = new Client();
        $client->setFirstName('pierre')
            ->setLastName('marceau')
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setEmail('.pierre@marceau.com');
        $this->loadMaterial($manager, $client,2800);
        $manager->persist($client);

        $client = new Client();
        $client->setFirstName('hugo')
            ->setLastName('pierre')
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setEmail('.hugo@hugo.com');
        $this->loadMaterial($manager, $client, 3000);
        $manager->persist($client);

        $manager->flush();
    }


    /**
     * @param ObjectManager $manager
     * @param Client $client
     * @param int $sum
     * @return Client
     */
    private function loadMaterial(ObjectManager $manager, Client $client, int $sum) : client
    {
        for ($i=1;$i<35;$i++) {
            $material = new Material();
            $material
                ->setPrice($sum + $i)
                ->setName('material ' . $i)
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setDescription('description material ' . $i);
            $manager->persist($material);
            $client->addMaterial($material);
        }
        return $client;
    }
}

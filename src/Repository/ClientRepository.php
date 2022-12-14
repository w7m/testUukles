<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function save(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array
     */
    public function getSold() : array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.materials','cm')
            ->addSelect('SUM(cm.price) as sumPrice')
            ->addSelect('AVG(cm.price) as rentable')
            ->groupBy('c.id')
            ->orderBy('sumPrice','DESC')
            ->addOrderBy('rentable','DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $nbrMaterial
     * @param float $price
     * @return array
     */
    public function getClientByNbrMaterial(int $nbrMaterial, float $price): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.materials','cm')
            ->addSelect('COUNT(cm.id) as nbrMaterial')
            ->having('nbrMaterial > :nbr')
            ->setParameter('nbr',$nbrMaterial)
            ->andWhere('cm.price > :price')
            ->setParameter('price',$price)
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }
}

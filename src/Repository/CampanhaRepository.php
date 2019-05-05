<?php

namespace App\Repository;

use App\Entity\Campanha;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Campanha|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campanha|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campanha[]    findAll()
 * @method Campanha[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampanhaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Campanha::class);
    }

    // /**
    //  * @return Campanha[] Returns an array of Campanha objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Campanha
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Cla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cla|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cla|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cla[]    findAll()
 * @method Cla[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClaRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Cla::class);
    }

    public function countMembros() {
        $query = ' SELECT c.id, count(m.cpf) total FROM cla c ';
        $query .= ' LEFT JOIN membro m ON c.id = m.cla_id ';
        $query .= ' GROUP BY c.id ';
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping;
        $rsm->addScalarResult('id', 'id', 'integer');
        $rsm->addScalarResult('total', 'membros', 'integer');
        return $this->getEntityManager()->createNativeQuery($query, $rsm)
                ->getResult();
    }

    // /**
    //  * @return Cla[] Returns an array of Cla objects
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
      public function findOneBySomeField($value): ?Cla
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

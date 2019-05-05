<?php

namespace App\Repository;

use App\Entity\Pontuacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pontuacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pontuacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pontuacao[]    findAll()
 * @method Pontuacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PontuacaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pontuacao::class);
    }
    
    public function groupByCla(\App\Entity\Campanha $campanha) {
        $query = ' SELECT p.cla_id, c.nome, sum(p.pontos) total FROM pontuacao p ';
        $query.= ' JOIN cla c ON c.id = p.cla_id ';
        $query.= ' WHERE p.campanha_id = :ci ';
        $query.= ' GROUP BY p.cla_id, c.nome ';
        $query.= ' ORDER BY sum(p.pontos) DESC ';
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping;
        $rsm->addScalarResult('cla_id', 'id', 'integer');
        $rsm->addScalarResult('nome', 'nome');
        $rsm->addScalarResult('total', 'pontos', 'integer');
        return $this->getEntityManager()->createNativeQuery($query, $rsm)
                ->setParameter(':ci', $campanha->getId())
                ->getResult();
    }

    // /**
    //  * @return Pontuacao[] Returns an array of Pontuacao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pontuacao
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

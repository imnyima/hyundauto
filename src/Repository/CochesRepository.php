<?php

namespace App\Repository;

use App\Entity\Coches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coches>
 *
 * @method Coches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coches[]    findAll()
 * @method Coches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CochesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coches::class);
    }

//    /**
//     * @return Coches[] Returns an array of Coches objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coches
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

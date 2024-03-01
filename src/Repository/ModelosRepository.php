<?php

namespace App\Repository;

use App\Entity\Modelos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modelos>
 *
 * @method Modelos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modelos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modelos[]    findAll()
 * @method Modelos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modelos::class);
    }

//    /**
//     * @return Modelos[] Returns an array of Modelos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Modelos
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /*
    * Sentencia SQL a definir:
    * SELECT modelos.id, nombre_tipo, nombre_modelo
    * FROM tipos
    * INNER JOIN modelos
    * ON tipos.id = modelos.id_tipo_id;
    */

// JOIN:
    public function joinModelos(): array {
        return $this->createQueryBuilder("modelos")
        ->innerJoin("modelos.id_tipo", "tipos")
        ->select("modelos.id", "tipos.nombre_tipo", "modelos.nombre_modelo")
        ->orderBy("modelos.nombre_modelo", "ASC")
        ->getQuery()
        ->getResult();
    }

// MÉTODO PARA ELIMINAR UN MODELO POR ID:
/*
    public function borraModelo($gestorEntidades, $id){
        $modeloBorrado = $this->find($id);

        $gestorEntidades->remove($modeloBorrado);
        $gestorEntidades->flush();
    }
*/
}

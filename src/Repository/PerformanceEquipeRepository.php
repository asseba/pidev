<?php

namespace App\Repository;

use App\Entity\PerformanceEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PerformanceEquipe>
 *
 * @method PerformanceEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformanceEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformanceEquipe[]    findAll()
 * @method PerformanceEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformanceEquipe::class);
    }

    public function save(PerformanceEquipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PerformanceEquipe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PerformanceEquipe[] Returns an array of PerformanceEquipe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PerformanceEquipe
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

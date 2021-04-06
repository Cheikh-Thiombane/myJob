<?php

namespace App\Repository;

use App\Entity\NiveauExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NiveauExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauExperience[]    findAll()
 * @method NiveauExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauExperience::class);
    }

    // /**
    //  * @return NiveauExperience[] Returns an array of NiveauExperience objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauExperience
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

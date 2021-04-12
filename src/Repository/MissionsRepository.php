<?php

namespace App\Repository;

use App\Entity\Missions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Missions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Missions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Missions[]    findAll()
 * @method Missions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Missions::class);
    }

    /**
     * Undocumented function
     *
     * @param string|string $term
     * @return Missions[]
     */
    public function findAllWithSearch(?string $term, ?string $ordre)
    {
        $qb = $this->createQueryBuilder('c');

        if ($term) {
            //$qb->andWhere('c.TitleMission LIKE :term OR c.NameCode LIKE :term')
            $qb->andWhere('c.TitleMission LIKE :term')
              ->setParameter('term','%'.$term.'%')
            ;
        }

        return $qb
            //->orderBy('c.TitleMission','ASC')
            ->orderBy('c.TitleMission', $ordre)
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return Missions[] Returns an array of Missions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Missions
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }


    public function getJobByCategory($id)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.category = :val')
            ->setParameter('val', $id)
            ->orderBy('j.id', 'ASC')
            ->getQuery()
        ;
    }


    public function getSearchedJobs($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.location LIKE :val')
            ->orWhere('j.title LIKE :val')
            ->orWhere('j.company LIKE :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}

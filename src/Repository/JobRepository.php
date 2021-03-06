<?php

namespace App\Repository;

use App\Entity\Job;
use App\Entity\JobSearch;
use App\Form\JobSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use ProxyManager\ProxyGenerator\Util\Properties;

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

    /**
     * @return Query
     */
    public function findAllAvailableQuery(JobSearch $search): Query
    {
        $query = $this->findVisibleQuery();
        if($search->getMinSalary()){
            $query = $query
                ->andWhere('j.salary >= :minSalary')
                ->setParameter('minSalary', $search->getMinSalary());
        }

        if($search->getTechnos()->count() > 0){
            $k = 0;
            foreach ($search->getTechnos() as $techno){
                $query = $query
                    ->andWhere(":techno$k MEMBER OF j.technos")
                    ->setParameter("techno$k", $techno);
                $k++;
            }

            $query = $query
                ->andWhere('j.salary >= :minSalary')
                ->setParameter('minSalary', $search->getMinSalary());
        }



        return $query->getQuery();
    }

    /**
     * @return Job[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.is_available = true');
    }

    // /**
    //  * @return Job[] Returns an array of Job objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Job
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Bien;
use App\Entity\BienSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bien>
 *
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

        /**
         * @return Bien[] Returns an array of Bien objects
         */
        public function searchBien(BienSearch $search): array
        {
            $query = $this->findVisibleQuery();

            if($search->getPrixMax()){
                $query = $query
                    ->andWhere('b.prix <= :maxprice')
                    ->setParameter('maxprice', $search->getPrixMax());
            }
            if($search->getSurface()){
                $query = $query
                    ->andWhere('b.surface >= :surfacemini')
                    ->setParameter('surfacemini', $search->getSurface());
            }
            if($search->getVille()){
                $query = $query
                    ->andWhere('b.ville <= :ville')
                    ->setParameter('ville', $search->getVille());
            }
            
            return $query->getQuery()->getResult();
        }

        private function findVisibleQuery(): QueryBuilder
        {
            return $this->createQueryBuilder('b');
        }

        // /**
        // * @return Bien[] Returns an array of Bien objects
        // */
        /*public function findByExampleField($value): array
        {
            return $this->createQueryBuilder('b')
                ->andWhere('b.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('b.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }*/

    //    public function findOneBySomeField($value): ?Bien
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

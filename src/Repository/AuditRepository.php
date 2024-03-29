<?php

namespace App\Repository;

use App\Entity\Audit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Audit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Audit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Audit[]    findAll()
 * @method Audit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Audit::class);
    }

    public function transform(Audit $audit)
    {
        return [
            'id'    => (int) $audit->getId(),
            'title' => (string) $audit->getTitle(),
            'description' => (string) $audit->getDescription(),
            'no_of_category'    => (int) $audit->getNoOfCategory(),
            'no_of_section'    => (int) $audit->getNoOfSection(),
        ];
    }

    public function transformAll()
    {
        $audits = $this->findAll();
        $auditsArray = [];

        foreach ($audits as $audit) {
            $auditsArray[] = $this->transform($audit);
        }

        return $auditsArray;
    }

    // /**
    //  * @return Audit[] Returns an array of Audit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Audit
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

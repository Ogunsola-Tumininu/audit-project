<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function transform(Category $category)
    {
        return [
            'id'    => (int) $category->getId(),
            'name' => (string) $category->getName(),
            'cat_id' => (string) $category->getCatId(),
            'audit_id'    => (int) $category->getAuditId(),
        ];
    }

    public function transformAll()
    {
        $categories = $this->findAll();
        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[] = $this->transform($category);
        }

        return $categoriesArray;
    }


    public function transformArray($categories)
    {
        // $categories = $this->findAll();
        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[] = $this->transform($category);
        }

        return $categoriesArray;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

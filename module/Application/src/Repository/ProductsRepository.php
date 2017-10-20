<?php
namespace Application\Repository;

use Application\Entity\Products;
use Doctrine\ORM\EntityRepository;

/**
 * This is the custom repository class for Post entity.
 */
class ProductsRepository extends EntityRepository
{
    /**
     * Retrieves all products with status new.
     * @return Query
     */
    public function findNewProducts()
    {
        $entityManager = $this->getEntityManager();
        
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('p')
            ->from(Products::class, 'p')
            ->where('p.status = ?1')
            ->setParameter(1, 'new');
        
        return $queryBuilder->getQuery();
    }
    /**
     * Retrieves all products.
     * @return Query
     */
    public function findProducts()
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
            ->from(Products::class, 'p')
            ->where('p.id > 0');

        return $queryBuilder->getQuery();
    }

}
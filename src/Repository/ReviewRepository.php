<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);

    }

    public function findLatestReviews(): array
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }

    public function getCompanyStatistics(): array
    {
        return $this->createQueryBuilder('r')
            ->select('
            r.companyName AS companyName,
            COUNT(r.id) AS reviewCount,
            AVG(r.rating) AS averageRating
        ')
            ->groupBy('r.companyName')
            ->orderBy('averageRating', 'DESC')
            ->getQuery()
            ->getResult();
    }

}

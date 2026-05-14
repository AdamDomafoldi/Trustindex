<?php

namespace App\Tests\Repository;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReviewRepositoryTest extends KernelTestCase
{
    public function testCompanyStatisticsAreCalculatedAndSortedByAverageRatingDesc(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);

        /** @var ReviewRepository $repository */
        $repository = $container->get(ReviewRepository::class);

        // Clean table before test
        $entityManager->createQuery('DELETE FROM App\Entity\Review r')
            ->execute();

        // Company A average = 4.0
        $this->createReview($entityManager, 'Company A', 5);
        $this->createReview($entityManager, 'Company A', 3);

        // Company B average = 5.0
        $this->createReview($entityManager, 'Company B', 5);
        $this->createReview($entityManager, 'Company B', 5);

        // Company C average = 2.0
        $this->createReview($entityManager, 'Company C', 2);

        $entityManager->flush();

        $stats = $repository->getCompanyStatistics();

        self::assertCount(3, $stats);

        // Check sorting
        self::assertSame('Company B', $stats[0]['companyName']);
        self::assertSame('Company A', $stats[1]['companyName']);
        self::assertSame('Company C', $stats[2]['companyName']);

        // Check review counts
        self::assertEquals(2, $stats[0]['reviewCount']);
        self::assertEquals(2, $stats[1]['reviewCount']);
        self::assertEquals(1, $stats[2]['reviewCount']);

        // Check averages
        self::assertEquals(5.0, (float) $stats[0]['averageRating']);
        self::assertEquals(4.0, (float) $stats[1]['averageRating']);
        self::assertEquals(2.0, (float) $stats[2]['averageRating']);
    }

    private function createReview(
        EntityManagerInterface $entityManager,
        string $companyName,
        int $rating
    ): void {
        $review = new Review();

        $review->setCompanyName($companyName);
        $review->setRating($rating);
        $review->setReviewText('Test review');
        $review->setAuthorEmail(uniqid('test_', true) . '@example.com');

        $entityManager->persist($review);
    }
}

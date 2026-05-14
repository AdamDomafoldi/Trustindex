<?php

namespace App\Tests\Unit;

use App\Entity\Review;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class ReviewTest extends TestCase
{
    public function testValidateRatingAcceptsValidRating(): void
    {
        $review = new Review();
        $review->setRating(5);

        $context = $this->createMock(ExecutionContextInterface::class);

        $context
            ->expects(self::never())
            ->method('buildViolation');

        $review->validateRating($context);
    }

    public function testValidateRatingRejectsInvalidRating(): void
    {
        $review = new Review();
        $review->setRating(6);

        $violationBuilder = $this->createMock(ConstraintViolationBuilderInterface::class);

        $violationBuilder
            ->expects(self::once())
            ->method('atPath')
            ->with('rating')
            ->willReturnSelf();

        $violationBuilder
            ->expects(self::once())
            ->method('addViolation');

        $context = $this->createMock(ExecutionContextInterface::class);

        $context
            ->expects(self::once())
            ->method('buildViolation')
            ->with('A rating must be between 1 and 5.')
            ->willReturn($violationBuilder);

        $review->validateRating($context);
    }
}

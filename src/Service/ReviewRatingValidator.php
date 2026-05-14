<?php

namespace App\Service;

class ReviewRatingValidator
{
    public function isValid(int $rating): bool
    {
        return $rating >= 1 && $rating <= 5;
    }
}

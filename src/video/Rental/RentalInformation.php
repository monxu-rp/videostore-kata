<?php

namespace VideoStoreKata\video\Rental;

use VideoStoreKata\video\Movie\Movie;

/**
 * Class RentalInformation.
 */
class RentalInformation
{
    /** @var Movie */
    private $movie;

    /** @var int */
    private $daysRented;

    /** @var float */
    private $amount;

    /** @var float */
    private $frequentRenterPoints;

    /**
     * @param Movie $movie
     * @param int   $daysRented
     * @param float $amount
     * @param float $frequentRenterPoints
     */
    private function __construct(Movie $movie, int $daysRented, float $amount, float $frequentRenterPoints)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
        $this->amount = $amount;
        $this->frequentRenterPoints = $frequentRenterPoints;
    }

    public static function instanceRentalInformation(Movie $movie, int $daysRented, float $amount, float $frequentRenterPoints)
    {
        return new static($movie, $daysRented, $amount, $frequentRenterPoints);
    }

    /**
     * @return Movie
     */
    public function movie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function frequentRenterPoints(): float
    {
        return $this->frequentRenterPoints;
    }

    public function getMovieTitle(): string
    {
        return $this->movie()->title();
    }

    /**
     * @return int
     */
    public function daysRented(): int
    {
        return $this->daysRented;
    }
}

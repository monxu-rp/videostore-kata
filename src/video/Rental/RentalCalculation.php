<?php

namespace VideoStoreKata\video\Rental;

use VideoStoreKata\video\Movie\Movie;
use VideoStoreKata\video\Movie\MovieType;
use VideoStoreKata\video\Rental\RentalFrequentPointsCalculator\DetermineFrequentPointsByFixedPoints;
use VideoStoreKata\video\Rental\RentalFrequentPointsCalculator\DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint;
use VideoStoreKata\video\Rental\RentalFrequentPointsCalculator\RentalFrequentPointsCalculatorInterface;
use VideoStoreKata\video\Rental\RentalPriceCalculator\DetermineAmountByFixedPriceMinDayAndPricePerDay;
use VideoStoreKata\video\Rental\RentalPriceCalculator\DetermineAmountByFixedPricePerDay;
use VideoStoreKata\video\Rental\RentalPriceCalculator\RentalPriceCalculatorInterface;

/**
 * Class RentalCalculation.
 */
class RentalCalculation
{
    /** @var Movie */
    private $movie;

    /**
     * @param Movie $movie
     */
    private function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public static function instanceRentalCalculation(Movie $movie): RentalCalculation
    {
        return new self($movie);
    }

    private function calculateRentalAmount(int $daysRented): float
    {
        /** @var RentalPriceCalculatorInterface $rentalAmount */
        $rentalAmount = null;

        switch ($this->movie->getMovieType()) {
            case MovieType::REGULAR:
                $rentalAmount = DetermineAmountByFixedPriceMinDayAndPricePerDay::instance(2, 2, 1.5);
                break;
            case MovieType::CHILDREN:
                $rentalAmount = DetermineAmountByFixedPriceMinDayAndPricePerDay::instance(1.5, 3, 1.5);
                break;
            case MovieType::NEW_RELEASE:
                $rentalAmount = DetermineAmountByFixedPricePerDay::instance(3);
                break;
        }

        return $rentalAmount->determineRentalAmount($daysRented);
    }

    private function calculateRentalFrequentPoints(int $daysRented): int
    {
        /** @var RentalFrequentPointsCalculatorInterface $rentalFrequentPoints */
        $rentalFrequentPoints = null;

        switch ($this->movie->getMovieType()) {
            case MovieType::REGULAR:
                $rentalFrequentPoints = DetermineFrequentPointsByFixedPoints::instance(1);
                break;
            case MovieType::CHILDREN:
                $rentalFrequentPoints = DetermineFrequentPointsByFixedPoints::instance(1);
                break;
            case MovieType::NEW_RELEASE:
                $rentalFrequentPoints = DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint::instance(1, 2, 1);
                break;
        }

        return $rentalFrequentPoints->determineFrequentRenterPoints($daysRented);
    }

    public function totalRental(int $daysRented): RentalInformation
    {
        $amount = $this->calculateRentalAmount($daysRented);
        $frequentRenterPoints = $this->calculateRentalFrequentPoints($daysRented);

        return RentalInformation::instanceRentalInformation($this->movie, $daysRented, $amount, $frequentRenterPoints);
    }
}

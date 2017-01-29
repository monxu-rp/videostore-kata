<?php

namespace video\Rental;

use video\Movie\Movie;
use video\Movie\MovieType;
use video\Rental\RentalFrequentPointsCalculator\DetermineFrequentPointsByFixedPoints;
use video\Rental\RentalFrequentPointsCalculator\DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint;
use video\Rental\RentalFrequentPointsCalculator\RentalFrequentPointsCalculator;
use video\Rental\RentalPriceCalculator\DetermineAmountByFixedPriceMinDayAndPricePerDay;
use video\Rental\RentalPriceCalculator\DetermineAmountByFixedPricePerDay;
use video\Rental\RentalPriceCalculator\RentalPriceCalculator;

/**
 * Class RentalCalculation
 */
class RentalCalculation
{
    /** @var RentalPriceCalculator[] */
    private $calculateRentalAmount;

    /** @var RentalFrequentPointsCalculator[] */
    private $calculateRentalFrequentPoints;

    /**
     * @param $calculateRentalAmount
     * @param $calculateRentalFrequentPoints
     */
    private function __construct($calculateRentalAmount, $calculateRentalFrequentPoints)
    {
        $this->calculateRentalAmount = $calculateRentalAmount;
        $this->calculateRentalFrequentPoints = $calculateRentalFrequentPoints;
    }

    public static function getRentalCalculationFactory(): RentalCalculation
    {
        $amountStrategies = array(
            MovieType::CHILDREN => new DetermineAmountByFixedPriceMinDayAndPricePerDay(1.5, 3, 1.5),
            MovieType::NEW_RELEASE => new DetermineAmountByFixedPricePerDay(3),
            MovieType::REGULAR => new DetermineAmountByFixedPriceMinDayAndPricePerDay(2, 2, 1.5)
        );
        $frequentRenterPointsStrategies = array(
            MovieType::CHILDREN => new DetermineFrequentPointsByFixedPoints(1),
            MovieType::NEW_RELEASE => new DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint(1, 2, 1),
            MovieType::REGULAR => new DetermineFrequentPointsByFixedPoints(1)
        );

        return new self($amountStrategies, $frequentRenterPointsStrategies);
    }

    private function calculateRentalAmount(Movie $movie, int $daysRented): float
    {
        return $this->calculateRentalAmount[$movie->getMovieType()]->determineRentalAmount($daysRented);
    }

    private function calculateRentalFrequentPoints(Movie $movie, int $daysRented): int
    {
        return $this->calculateRentalFrequentPoints[$movie->getMovieType()]->determineFrequentRenterPoints($daysRented);
    }

    public function totalRental(Movie $movie, int $daysRented): RentalInformation
    {
        $amount = $this->calculateRentalAmount($movie, $daysRented);
        $frequentRenterPoints = $this->calculateRentalFrequentPoints($movie, $daysRented);

        return RentalInformation::instanceRentalInformation($movie, $daysRented, $amount, $frequentRenterPoints);
    }

}

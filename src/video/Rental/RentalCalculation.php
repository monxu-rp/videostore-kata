<?php

namespace video\Rental;

use video\Movie\Movie;
use video\Movie\MovieType;
use video\Rental\RentalFrequentPointsCalculator\RentalFrequentPointsCalculator;
use video\Rental\RentalPriceCalculator\RentalPriceCalculator;

/**
 * Class RentalCalculation
 */
class RentalCalculation
{
    /** @var RentalPriceCalculator */
    private $calculateRentalAmount;

    /** @var RentalFrequentPointsCalculator */
    private $calculateRentalFrequentPoints;

    /**
     * @param RentalPriceCalculator $calculateRentalAmount
     * @param RentalFrequentPointsCalculator $calculateRentalFrequentPoints
     */
    public function __construct(
        RentalPriceCalculator $calculateRentalAmount,
        RentalFrequentPointsCalculator $calculateRentalFrequentPoints
    ) {
        $this->calculateRentalAmount = $calculateRentalAmount;
        $this->calculateRentalFrequentPoints = $calculateRentalFrequentPoints;
    }

//    private function getMovieFactory(Movie $movie): MovieTypeRentalFactory
//    {
//        switch ($movie->getMovieType()) {
//            case MovieType::CHILDREN:
//                return $this->childrensMovieTypeRentalFactory;
//                break;
//            case MovieType::NEW_RELEASE:
//                return $this->newReleaseMovieTypeRentalFactory;
//                break;
//            case MovieType::REGULAR:
//                return $this->regularMovieTypeRentalFactory;
//                break;
//            default:
//                throw new \InvalidArgumentException();
//        }
//    }

    private function calculateRentalAmount(int $daysRented)
    {
        return $this->calculateRentalAmount->determineRentalAmount($daysRented);
    }

    private function calculateRentalFrequentPoints(int $daysRented)
    {
        return $this->calculateRentalFrequentPoints->determineFrequentRenterPoints($daysRented);
    }

    public function totalRental(Movie $movie, int $daysRented)
    {
        $amount = $this->calculateRentalAmount($daysRented);
        $frequentRenterPoints = $this->calculateRentalFrequentPoints($daysRented);

        return RentalInformation::instanceRentalInformation($movie, $daysRented, $amount, $frequentRenterPoints);
    }

}

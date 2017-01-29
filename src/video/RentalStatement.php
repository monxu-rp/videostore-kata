<?php

namespace video;

use video\Rental\RentalInformation;

/**
 * Class RentalStatement
 */
class RentalStatement
{
    /** @var  string */
    private $name;
    /** @var  float */
    private $totalAmount;
    /** @var  int */
    private $frequentRenterPoints;
    /** @var  array */
    private $rentals;

    /**
     * RentalStatement constructor.
     * @param $customerName
     */
    public function __construct($customerName)
    {
        $this->name = $customerName;
    }

    /**
     * @param RentalInformation $rental
     */
    public function addRental($rental)
    {
        $this->rentals[] = $rental;
    }

    /**
     * @return string
     */
    public function makeRentalStatement()
    {
        $this->clearTotals();

        return $this->makeHeader() . $this->makeRentalLines() . $this->makeSummary();
    }

    /**
     * Reset amount and points.
     */
    private function clearTotals()
    {
        $this->totalAmount = 0;
        $this->frequentRenterPoints = 0;
    }

    /**
     * @return string
     */
    private function makeHeader() : string
    {
        return "Rental Record for " . $this->name() . "\n";
    }

    /**
     * @return string
     */
    private function makeRentalLines() : string
    {
        $rentalLines = "";

        foreach ($this->rentals as $rental) {
            $rentalLines .= $this->makeRentalLine($rental);
        }

        return $rentalLines;
    }

    /**
     * @param RentalInformation $rental
     * @return string
     */
    private function makeRentalLine($rental) : string
    {
        /** @var float $thisAmount */
        $thisAmount = $rental->amount();

        $this->frequentRenterPoints += $rental->frequentRenterPoints();
        $this->totalAmount += $thisAmount;

        return $this->formatRentalLine($rental, $thisAmount);
    }

    /**
     * @param RentalInformation $rental
     * @param float $thisAmount
     * @return string
     */
    private function formatRentalLine($rental, $thisAmount) : string
    {
        return "\t" . $rental->getMovieTitle() . "\t" . number_format($thisAmount, 1) . "\n";
    }

    /**
     * @return string
     */
    private function makeSummary() : string
    {
        return "You owed " . $this->totalAmount . "\n" . "You earned " . $this->frequentRenterPoints . " frequent renter points\n";
    }

    /**
     * Name accessor.
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    /**
     * Amount owed accessor.
     * @return float
     */
    public function amountOwed() : float
    {
        return $this->totalAmount;
    }

    /**
     * Frequent renter points accessor.
     * @return int
     */
    public function frequentRenterPoints() : int
    {
        return $this->frequentRenterPoints;
    }
}

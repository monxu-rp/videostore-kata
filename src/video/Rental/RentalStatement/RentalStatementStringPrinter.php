<?php
namespace video\Rental\RentalStatement;


use video\Rental\RentalInformation;

class RentalStatementStringPrinter implements RentalStatementPrinter
{
    public function makeRentalStatement(RentalStatement $rentalStatement): string
    {
        return
            $this->makeHeader($rentalStatement) .
            $this->makeRentalLines($rentalStatement) .
            $this->makeSummary($rentalStatement);
    }

    private function makeHeader(RentalStatement $rentalStatement): string
    {
        return "Rental Record for " . $rentalStatement->customerName() . "\n";
    }

    private function makeRentalLines(RentalStatement $rentalStatement): string
    {
        $rentalLines = "";

        foreach ($rentalStatement->getRentals() as $rental) {
            $rentalLines .= $this->makeRentalLine($rental);
        }

        return $rentalLines;
    }


    private function makeRentalLine(RentalInformation $rental): string
    {
        return "\t" . $rental->getMovieTitle() . "\t" . number_format((float) $rental->amount(), 1, '.', '') . "\n";
    }

    private function makeSummary(RentalStatement $rentalStatement): string
    {
        return "You owed " . $rentalStatement->amountOwed() . "\n"
            . "You earned " . $rentalStatement->frequentRenterPoints() . " frequent renter points\n";
    }
}
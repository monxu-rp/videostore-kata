<?php

namespace video\Rental\RentalStatement;

/**
 * Interface RentalStatementPrinter
 */
interface RentalStatementPrinter
{
    public function makeRentalStatement(RentalStatement $rentalStatement): string;
}

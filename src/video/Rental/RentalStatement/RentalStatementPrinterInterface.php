<?php

namespace video\Rental\RentalStatement;

/**
 * Interface RentalStatementPrinterInterface
 */
interface RentalStatementPrinterInterface
{
    public function makeRentalStatement(RentalStatement $rentalStatement): string;
}

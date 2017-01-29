<?php

namespace video\Rental\RentalPriceCalculator;

/**
 * Interface RentalPriceCalculator
 */
interface RentalPriceCalculator
{
    public function determineRentalAmount(int $days): float;
}

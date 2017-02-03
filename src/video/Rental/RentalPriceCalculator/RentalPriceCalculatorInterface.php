<?php

namespace VideoStoreKata\video\Rental\RentalPriceCalculator;

/**
 * Interface RentalPriceCalculatorInterface
 */
interface RentalPriceCalculatorInterface
{
    public function determineRentalAmount(int $days): float;
}

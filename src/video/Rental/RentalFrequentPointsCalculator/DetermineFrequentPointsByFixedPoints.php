<?php

namespace VideoStoreKata\video\Rental\RentalFrequentPointsCalculator;

/**
 * Class DetermineFrequentPointsByFixedPoints.
 */
class DetermineFrequentPointsByFixedPoints implements RentalFrequentPointsCalculatorInterface
{
    /** @var int */
    private $fixedPoints;

    /**
     * @param int $fixedPoints
     */
    private function __construct(int $fixedPoints)
    {
        $this->fixedPoints = $fixedPoints;
    }

    /**
     * @param int $fixedPoints
     *
     * @return DetermineFrequentPointsByFixedPoints
     */
    public static function instance(int $fixedPoints):DetermineFrequentPointsByFixedPoints
    {
        return new static($fixedPoints);
    }

    /**
     * @param int $days
     *
     * @return int
     */
    public function determineFrequentRenterPoints(int $days): int
    {
        return $this->fixedPoints;
    }
}

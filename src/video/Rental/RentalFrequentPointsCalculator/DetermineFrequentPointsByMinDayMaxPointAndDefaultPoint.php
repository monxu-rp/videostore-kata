<?php

namespace VideoStoreKata\video\Rental\RentalFrequentPointsCalculator;

/**
 * Class DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint
 */
class DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint implements RentalFrequentPointsCalculatorInterface
{
    /** @var  int */
    private $minDay;
    /** @var  int */
    private $maxPoint;
    /** @var  int */
    private $defaultPoint;

    /**
     * @param int $minDay
     * @param int $maxPoint
     * @param int $defaultPoint
     */
    public function __construct(int $minDay, int $maxPoint, int $defaultPoint)
    {
        $this->minDay = $minDay;
        $this->maxPoint = $maxPoint;
        $this->defaultPoint = $defaultPoint;
    }

    public function determineFrequentRenterPoints(int $days): int
    {
        return ($days > $this->minDay) ? $this->maxPoint : $this->defaultPoint;
    }
}

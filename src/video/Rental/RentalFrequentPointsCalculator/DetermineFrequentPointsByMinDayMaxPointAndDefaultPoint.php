<?php

namespace video\Rental\RentalFrequentPointsCalculator;

/**
 * Class DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint
 */
class DetermineFrequentPointsByMinDayMaxPointAndDefaultPoint implements RentalFrequentPointsCalculator
{
    /** @var  int */
    private $minDate;
    /** @var  int */
    private $maxPoint;
    /** @var  int */
    private $defaultPoint;

    /**
     * @param int $minDate
     * @param int $maxPoint
     * @param int $defaultPoint
     */
    public function __construct(int $minDate, int $maxPoint, int $defaultPoint)
    {
        $this->minDate = $minDate;
        $this->maxPoint = $maxPoint;
        $this->defaultPoint = $defaultPoint;
    }

    public function determineFrequentRenterPoints(int $days): int
    {
        return ($days > $this->minDate) ? $this->maxPoint : $this->defaultPoint;
    }
}

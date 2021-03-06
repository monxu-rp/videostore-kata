<?php
namespace VideoStoreKata\video\Rental\RentalStatement;

use VideoStoreKata\video\Customer\Customer;
use VideoStoreKata\video\Rental\RentalInformation;

class RentalStatement
{
    /** @var Customer */
    private $customer;
    /** @var RentalStatementPrinterInterface */
    private $printer;
    /** @var RentalInformation[] */
    private $rentals = array();
    /** @var float */
    private $amount = 0;
    /** @var float */
    private $frequentRenterPoints = 0;

    /**
     * RentalStatement constructor.
     * @param Customer $customer
     * @param RentalStatementPrinterInterface $printer
     * @internal param Customer $customer
     */
    public function __construct(Customer $customer, RentalStatementPrinterInterface $printer)
    {
        $this->customer = $customer;
        $this->printer = $printer;
    }

    /**
     * @param RentalInformation $rental
     */
    public function addRental(RentalInformation $rental)
    {
        $this->rentals[] = $rental;
        $this->amount += $rental->amount();
        $this->frequentRenterPoints += $rental->frequentRenterPoints();
    }

    /**
     * @return float
     */
    public function amountOwed()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function customerName(): string
    {
        return $this->customer->name();
    }

    /**
     * @return int
     */
    public function frequentRenterPoints(): int
    {
        return $this->frequentRenterPoints;
    }

    /**
     * @return RentalInformation[]
     */
    public function getRentals()
    {
        return $this->rentals;
    }

    public function makeRentalStatement()
    {
        return $this->printer->makeRentalStatement($this);
    }
}

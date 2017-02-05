<?php

namespace tests\Legacy;

use Exception;
use PHPUnit_Framework_TestCase;
use VideoStoreKata\video\Customer\Customer;
use VideoStoreKata\video\Movie\Movie;
use VideoStoreKata\video\Movie\MovieType;
use VideoStoreKata\video\Rental\RentalCalculation;
use VideoStoreKata\video\Rental\RentalStatement\RentalStatement;
use VideoStoreKata\video\Rental\RentalStatement\RentalStatementStringPrinter;

/**
 * Class VideoStoreTest
 */
class VideoStoreTest extends PHPUnit_Framework_TestCase
{
    /** @var  RentalStatement */
    private $statement;
    /** @var  Movie */
    private $newRelease1;
    /** @var  Movie */
    private $newRelease2;
    /** @var  Movie */
    private $childrens;
    /** @var  Movie */
    private $regular1;
    /** @var  Movie */
    private $regular2;
    /** @var  Movie */
    private $regular3;

    /** @var  RentalCalculation */
    private $rentalCalculation;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->statement = new RentalStatement(
            Customer::instanceCustomer('Customer Name'),
            new RentalStatementStringPrinter()
        );
        $this->newRelease1 = Movie::instanceMovie('New Release 1', MovieType::newRelease());
        $this->newRelease2 = Movie::instanceMovie('New Release 2', MovieType::newRelease());
        $this->childrens = Movie::instanceMovie('Childrens', MovieType::children());
        $this->regular1 = Movie::instanceMovie('Regular 1', MovieType::regular());
        $this->regular2 = Movie::instanceMovie('Regular 2', MovieType::regular());
        $this->regular3 = Movie::instanceMovie('Regular 3', MovieType::regular());
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->statement = null;
        $this->newRelease1 = null;
        $this->newRelease2 = null;
        $this->childrens = null;
        $this->regular1 = null;
        $this->regular2 = null;
        $this->regular3 = null;
    }

    private function assertAmountAndPointsForReport($expectedAmount, $expectedPoints)
    {
        $this->assertEquals($expectedAmount, $this->statement->amountOwed());
        $this->assertEquals($expectedPoints, $this->statement->frequentRenterPoints());
    }

    public function testSingleNewReleaseStatement()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->newRelease1)->totalRental(3)
        );
        $this->statement->makeRentalStatement();

        $this->assertAmountAndPointsForReport(9.0, 2);
    }

    public function testDualNewReleaseStatement()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->newRelease1)->totalRental(3)
        );
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->newRelease2)->totalRental(3)
        );
        $this->statement->makeRentalStatement();

        $this->assertAmountAndPointsForReport(18.0, 4);
    }

    public function testSingleChildrensStatement()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->childrens)->totalRental(3)
        );
        $this->statement->makeRentalStatement();

        $this->assertAmountAndPointsForReport(1.5, 1);
    }

    public function testMultipleRegularStatement()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular1)->totalRental(1)
        );
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular2)->totalRental(2)
        );
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular3)->totalRental(3)
        );
        $this->statement->makeRentalStatement();

        $this->assertAmountAndPointsForReport(7.5, 3);
    }

    public function testRentalStatementFormat()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular1)->totalRental(1)
        );
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular2)->totalRental(2)
        );
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->regular3)->totalRental(3)
        );

        $this->assertEquals(
            "Rental Record for Customer Name\n" .
            "\tRegular 1\t2.0\n" .
            "\tRegular 2\t2.0\n" .
            "\tRegular 3\t3.5\n" .
            "You owed 7.5\n" .
            "You earned 3 frequent renter points\n",
            $this->statement->makeRentalStatement()
        );
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function itShouldThrowAnExceptionWhenDayEqualZeroOrLessIsSendInNewReleaseMovie()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->newRelease1)->totalRental(0)
        );
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function itShouldThrowAnExceptionWhenDayEqualOrLessZeroIsSendInChildrenMovie()
    {
        $this->statement->addRental(
            RentalCalculation::instanceRentalCalculation($this->childrens)->totalRental(0)
        );
    }

    /**
     * @test
     */
    public function itShouldReturnTheMovieDaysRenter()
    {
        //Regular
        $rentalInformation = RentalCalculation::instanceRentalCalculation($this->regular1)->totalRental(1);
        $this->assertSame($rentalInformation->daysRented(), 1);

        $rentalInformation = RentalCalculation::instanceRentalCalculation($this->regular2)->totalRental(2);
        $this->assertSame($rentalInformation->daysRented(), 2);

        $rentalInformation = RentalCalculation::instanceRentalCalculation($this->regular3)->totalRental(3);
        $this->assertSame($rentalInformation->daysRented(), 3);

        //New Release
        $rentalInformation = RentalCalculation::instanceRentalCalculation($this->newRelease1)->totalRental(4);
        $this->assertSame($rentalInformation->daysRented(), 4);

        //Children
        $rentalInformation = RentalCalculation::instanceRentalCalculation($this->childrens)->totalRental(5);
        $this->assertSame($rentalInformation->daysRented(), 5);
    }
}

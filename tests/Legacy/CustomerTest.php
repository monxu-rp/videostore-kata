<?php
namespace tests\Legacy;

use VideoStoreKata\video\Customer\Customer;

/**
 * Class CustomerTest
 */
class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @test
     */
    public function itShouldReturnTheCustomerName()
    {
        $this->assertEquals("Customer Name", $this->customer->name());
    }

    protected function setUp()
    {
        $this->customer = Customer::instanceCustomer("Customer Name");
    }
}

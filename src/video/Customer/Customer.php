<?php

namespace VideoStoreKata\video\Customer;

/**
 * Class Customer
 */
class Customer
{
    /** @var  string */
    private $name;

    /**
     * Customer constructor.
     * @param $name
     */
    private function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Name accessor.
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Customer
     */
    public static function instanceCustomer(string $name)
    {
        return new self($name);
    }
}

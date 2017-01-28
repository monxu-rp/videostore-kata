<?php

namespace video\Customer;

/**
 * Class Customer
 */
class Customer
{
    /** @var  string */
    private $name;

    /** @var array  */
    private $rentals = [];

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

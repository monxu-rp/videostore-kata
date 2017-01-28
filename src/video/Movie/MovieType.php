<?php

namespace video\Movie;

/**
 * Class MovieType
 */
class MovieType
{
    const NEW_RELEASE = 1;
    const CHILDREN = 2;
    const REGULAR = 3;

    /** @var  int */
    private $type;

    /**
     * MovieType constructor.
     * @param int $type
     */
    private function __construct($type)
    {
        $this->type = $type;
    }

    public static function newRelease()
    {
        return new self(self::NEW_RELEASE);
    }

    public static function children()
    {
        return new self(self::CHILDREN);
    }

    public static function regular()
    {
        return new self(self::REGULAR);
    }

    public function type(): int
    {
        return $this->type;
    }
}

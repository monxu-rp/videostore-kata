<?php

namespace VideoStoreKata\video\Movie;

class Movie
{
    /** @var string */
    private $title;

    /** @var MovieType */
    private $type;

    /**
     * Movie constructor.
     * @param string $title
     * @param MovieType $type
     */
    private function __construct(string $title, MovieType $type)
    {
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * @param string $title
     * @param MovieType $type
     *
     * @return static
     */
    public static function instanceMovie(string $title, MovieType $type)
    {
        return new static($title, $type);
    }

    /** @return string */
    public function title(): string
    {
        return $this->title;
    }

    /** @return MovieType */
    public function type(): MovieType
    {
        return $this->type;
    }

    public function getMovieType(): int
    {
        return $this->type()->type();
    }
}

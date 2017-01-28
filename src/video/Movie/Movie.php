<?php

namespace video\Movie;

class Movie
{
    /** @var string */
    private $title;

    /** @var MovieType */
    private $category;

    /**
     * Movie constructor.
     * @param string $title
     * @param MovieType $category
     */
    private function __construct(string $title, MovieType $category)
    {
        $this->title = $title;
        $this->category = $category;
    }

    public static function instanceMovie(string $title, MovieType $category)
    {
        return new static($title, $category);
    }

    /** @return string */
    public function title(): string
    {
        return $this->title;
    }

    /** @return MovieType */
    public function category(): MovieType
    {
        return $this->category;
    }
}
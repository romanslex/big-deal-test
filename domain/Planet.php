<?php

namespace Domain;

class Planet
{
    /** @var string */
    public $name;

    /** @var string */
    public $url;

    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url = $url;
    }
}
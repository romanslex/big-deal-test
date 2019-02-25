<?php

namespace Domain;

class Planet
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $url;

    public function __construct(int $id, string $name, string $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
    }
}
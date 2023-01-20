<?php


class Product
{
    public $id;
    public $name;
    public $picture;
    public $description;
    public $category;

    public function __construct()
    {
        settype($this->id, 'integer');
        settype($this->category, 'integer');
    }
}
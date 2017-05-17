<?php
use Phalcon\Mvc\Model;
class Product extends Model
{
    public function initialize()
    {
        $this->setSource("product");
    }
}
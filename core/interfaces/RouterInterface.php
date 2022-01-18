<?php


namespace core\interfaces;


interface RouterInterface
{
    public function route(): callable;
}
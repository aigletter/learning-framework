<?php


namespace core\interfaces;


interface ViewInterface
{
    public function view(string $template, $data = []);
}
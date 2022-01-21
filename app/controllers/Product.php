<?php


namespace app\controllers;


use core\Application;
use core\components\View\View;

class Product
{
    public function __construct()
    {
        Application::getApp()->get('cache')->set('temp', 'Hello world!');
    }

    public function show(int $id, string $type)
    {
        $view = Application::getApp()->get('view');
        $view->view('product-show', [
            'id' => $id,
            'test' => 'Test var',
            'temp' => Application::getApp()->get('cache')->get('temp'),
        ]);
    }
}
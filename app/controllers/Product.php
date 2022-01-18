<?php


namespace app\controllers;


use core\Application;
use core\components\View\View;

class Product
{
    public function show()
    {
        $view = Application::getApp()->getView();
        $view->view('product-show', [
            'test' => 'Test var'
        ]);
    }
}
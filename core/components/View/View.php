<?php

namespace core\components\View;

use core\interfaces\ViewInterface;

class View implements ViewInterface
{
    /**
     * @param string $template
     * @param array $data
     * [
     *      'name' => 'Test',
     *      'age' => 23
     * ]
     */
    public function view(string $template, $data = [])
    {
        $filename = ROOT_PATH . '/views/' . $template . '.php';
        if (file_exists($filename)) {
            extract($data);
            include $filename;
        } else {
            throw new \Exception('View file not found');
        }
    }
}
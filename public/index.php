<?php

/**
 * Входной скрипт, который будет запускаться для все динамических страниц
 */

use core\Application;

include __DIR__ . '/../vendor/autoload.php';

const ROOT_PATH = '/home/aigletter/www/learning-framework';

// Получаем конфиги с файла
$config = include dirname(__DIR__) . '/config/main.php';
// Сетим конфиги классу Application
Application::setConfig($config);

// Получаем класс приложения
$app = Application::getApp();
// Запускаем главную функцию
$app->run();
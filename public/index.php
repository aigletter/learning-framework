<?php

include __DIR__ . '/../vendor/autoload.php';

const ROOT_PATH = '/home/aigletter/www/learning-framework';

\core\Application::setComponents([
     'router' => new \core\components\Routing\Router(),
     'view' => new \core\components\View\View()
]);

$app = \core\Application::getApp();
$app->run();
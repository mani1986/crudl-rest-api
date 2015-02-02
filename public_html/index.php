<?php
require_once __DIR__ . '/../vendor/autoload.php';

$router = new \mani\blog\router\Router();
$router->run();

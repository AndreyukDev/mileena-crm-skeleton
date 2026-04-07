<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Mileena\CrmSkeleton\App;

session_start();
date_default_timezone_set("Europe/Moscow");


define('ROOT_DIR', getcwd() . '/');

// авто загрузчики
require 'vendor/autoload.php';

$config = new Mileena\Config(__DIR__.'/src/');
$app = new App($config);
$app->webRoute();

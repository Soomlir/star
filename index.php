<?php
require_once 'FileHelper.php';
require_once 'App.php';

error_reporting(0);
ini_set('display_errors', 0);

$config = require 'config.php';

$app = new App($config['path-images'], $config['save-dir'], $config['log-level']);
$app->run();

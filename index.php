<?php

use App\Process;

$loader = require 'vendor/autoload.php';
include 'app/loader.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

define('TOKEN', getenv('TB_TOKEN'));

$p = new Process();
$p->init();

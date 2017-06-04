<?php

use App\Process;

$loader = require 'vendor/autoload.php';
include 'app/loader.php';

$dotEnv = new \Dotenv\Dotenv(__DIR__);
$dotEnv->load();

define('TOKEN', getenv('TB_TOKEN'));

$process = new Process();
$process->constructor();
$process->init();

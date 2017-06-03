<?php
$loader->setPsr4('App\\', __DIR__ . '/');
$loader->setPsr4('App\\Services\\', __DIR__ . '/services');
$loader->setPsr4('App\\Services\\Telegram\\', __DIR__ . '/services/telegram');
$loader->setPsr4('App\\Services\\Telegram\\Update\\', __DIR__ . '/services/telegram/update');
$loader->setPsr4('App\\Services\\Telegram\\Update\\Message\\', __DIR__ . '/services/telegram/update/message');

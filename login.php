<?php
require_once __DIR__ . '/vendor/autoload.php';
use Hybridauth\Hybridauth;

$config = include 'hybridauth-config.php';

$hybridauth = new Hybridauth($config);
$adapter = $hybridauth->authenticate('Google');

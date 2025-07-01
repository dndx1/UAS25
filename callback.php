<?php
require_once __DIR__ . '/vendor/autoload.php';
use Hybridauth\Hybridauth;

$config = include 'hybridauth-config.php';
$hybridauth = new Hybridauth($config);

$adapter = $hybridauth->getAdapter('Google');
$profile = $adapter->getUserProfile();

session_start();
$_SESSION['nama'] = $profile->displayName;
$_SESSION['email'] = $profile->email;

echo "<h3>Halo, " . $_SESSION['nama'] . "</h3>";
echo "<p>Email: " . $_SESSION['email'] . "</p>";

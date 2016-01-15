<?php

include_once __DIR__ .'/../vendor/autoload.php';

use Scattr\Client\Client;

$username = getenv('SCATTR_USERNAME');
$password = getenv('SCATTR_PASSWORD');
$account = getenv('SCATTR_ACCOUNT');
$poolName = getenv('SCATTR_POOLNAME');
$url = getenv('SCATTR_URL');

if (!$username || !$password || !$account || !$url || !$poolName) {
    exit("Not all required env variables are set\n");
}

$client = new Client($username, $password, $account, $poolName, $url);

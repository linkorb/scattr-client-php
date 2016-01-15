<?php

include_once 'boot.php';

use Scattr\Client\Model\Job;

$job = new Job();
$job->setId('123');
$job->setSubject("This is a test job");

$res = $client->pushJob($job);
print_r($res);

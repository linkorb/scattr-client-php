<?php

include_once 'boot.php';

use Scattr\Client\Model\Job;

$job = new Job();
$job->setKey('hello.world.$');
$job->setClass('Cool\Stuff');
$job->setSubject("This is a test job");

$res = $client->pushJob($job);
print_r($res);

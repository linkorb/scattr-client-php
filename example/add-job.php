<?php

include_once 'boot.php';

$job = new Job();
$job->setKey('hello.world.$');
$job->setClass('Cool\Stuff');
$job->setSubject("This is a test job");

$res = $client->addJob($job);

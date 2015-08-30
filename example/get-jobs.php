<?php
include_once 'boot.php';

use Scattr\Client\Model\Job;

$jobs = $client->getJobs($job);
print_r($jobs);

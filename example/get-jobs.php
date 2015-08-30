<?php
include_once 'boot.php';

$jobs = $client->getJobs($job);
print_r($jobs);

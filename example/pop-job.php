<?php

include_once 'boot.php';

use Scattr\Client\Model\Job;

$job = $client->popJob();
if ($job) {
    print_r($job);
    $client->setFinished($job);
} else {
    echo "Noting to do...\n";
}

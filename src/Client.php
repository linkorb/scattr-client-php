<?php

namespace Scattr\Client;

use Scattr\Client\Model\Job;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $username;
    private $password;
    private $account;
    private $poolName;
    private $url;
    
    public function __construct($username, $password, $account, $poolName, $url)
    {
        $this->username = $username;
        $this->password = $password;
        $this->account = $account;
        $this->poolName = $poolName;
        $this->url = $url;
    }
    
    public function pushJob(Job $job)
    {
        $data = $this->serializeJob($job);
        $this->post(
            '/jobs/push',
            $data
        );
    }
    
    public function popJob()
    {
        $data = $this->get(
            '/jobs/pop'
        );
        if (!isset($data['id'])) {
            return null;
        }
        $job = $this->unserializeJob($data);
        return $job;
    }
    
    
    public function setFinished(Job $job, $statusCode)
    {
        $data = $this->get(
            '/jobs/' . $job->getId() . '/finish/' . $statusCode
        );
        return true;
    }
    
    public function getJobs()
    {
        $data = $this->get(
            '/jobs'
        );
        
        return $this->data2jobs($data);
    }

    public function postJobLog(Job $job, $level, $message)
    {
        return $this->post('/jobs/' . $job->getId() . '/log', ['level' => $level, 'message' => $message]);
    }
    
    private function data2jobs($data)
    {
        $jobs = array();
        foreach ($data['items'] as $item) {
            $job = $this->unserializeJob($item);
            $jobs[] = $job;
        }
        return $jobs;
    }
    
    private function unserializeJob($data)
    {
        $job = new Job();
        $job->setId($data['id']);
        $job->setCommand($data['command']);
        $job->setSubject(isset($data['subject']) ? $data['subject'] : null);
        $job->setLogs($data['logs']);
        $job->setParameters($data['parameters']);
        $job->setCreatedAt($data['created_at']);
        $job->setScheduledAt(isset($data['scheduled_at']) ? $data['scheduled_at'] : null);
        $job->setStartedAt($data['started_at']);
        $job->setFinishedAt($data['finished_at']);
        return $job;
    }
    
    private function serializeJob(Job $job)
    {
        $data = array();
        $data['id'] = $job->getId();
        $data['command'] = $job->getCommand();
        $data['subject'] = $job->getSubject();
        $data['logs'] = $job->getLogs();
        $data['parameters'] = $job->getParameters();
        $data['created_at'] = $job->getCreatedAt();
        $data['scheduled_at'] = $job->getScheduledAt();
        $data['started_at'] = $job->getStartedAt();
        $data['finished_at'] = $job->getFinishedAt();
        return $data;
    }
    
    private function post($path, $data)
    {
        $guzzleclient = new GuzzleClient();
        $url = $this->url . '/api/v1/';
        
        $url .= $this->account . '/' . $this->poolName . $path;
        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json'],
            'body' => json_encode($data, JSON_PRETTY_PRINT),
        ]);
        return ($res->getStatusCode() == 201);
    }
    
    private function get($path)
    {
        $guzzleclient = new GuzzleClient();
        $url = $this->url . '/api/v1/';

        $url .= $this->account . '/' . $this->poolName . $path;

        $res = $guzzleclient->get($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json']
        ]);
        if ($res->getStatusCode() == 200)
        {
            return json_decode($res->getBody(), true);
        }
        return array();
    }
}

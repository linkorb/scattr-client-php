<?php

namespace Scattr\Client;

use Scattr\Client\Model\Job;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $username;
    private $password;
    private $account;
    private $url;
    
    public function __construct($username, $password, $account, $url)
    {
        $this->username = $username;
        $this->password = $password;
        $this->account = $account;
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
        if (!isset($data['key'])) {
            return null;
        }
        $job = $this->unserializeJob($data);
        return $job;
    }
    
    
    public function setFinished(Job $job)
    {
        $data = $this->get(
            '/jobs/' . $job->getKey() . '/finished'
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
        $job->setKey($data['key']);
        $job->setClass($data['class']);
        $job->setSubject($data['subject']);
        $job->setParameters($data['parameters']);
        $job->setCreatedAt($data['created_at']);
        $job->setScheduledAt($data['scheduled_at']);
        $job->setStartedAt($data['started_at']);
        $job->setFinishedAt($data['finished_at']);
        return $job;
    }
    
    private function serializeJob(Job $job)
    {
        $data = array();
        $data['key'] = $job->getKey();
        $data['class'] = $job->getClass();
        $data['subject'] = $job->getSubject();
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
        
        $url .= $this->account . $path;
        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json'],
            'body' => json_encode($data, JSON_PRETTY_PRINT),
        ]);
        return ($res->getStatusCode() == 200);
    }
    
    private function get($path)
    {
        $guzzleclient = new GuzzleClient();
        $url = $this->url . '/api/v1/';
        
        $url .= $this->account . $path;

        $res = $guzzleclient->get($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json']
        ]);
        //return ($res->getStatusCode() == 200);
        $data = $res->getBody();
        return json_decode($data, true);
    }
}

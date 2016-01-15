<?php

namespace Scattr\Client\Model;

class Job
{
    private $subject;
    
    public function getSubject()
    {
        return $this->subject;
    }
    
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    
    private $id;
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    private $parameters;
    
    public function getParameters()
    {
        return $this->parameters;
    }
    
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
    
    private $createdAt;
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    

    private $scheduledAt;
    
    public function getScheduledAt()
    {
        return $this->scheduledAt;
    }
    
    public function setScheduledAt($scheduledAt)
    {
        $this->scheduledAt = $scheduledAt;
        return $this;
    }
    
    private $startedAt;
    
    public function getStartedAt()
    {
        return $this->startedAt;
    }
    
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;
        return $this;
    }
    
    private $finishedAt;
    
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }
    
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;
        return $this;
    }

    private $command;

    public function getCommand()
    {
        return $this->command;
    }

    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    private $logs;

    public function getLogs()
    {
        return $this->logs;
    }

    public function setLogs($logs)
    {
        $this->logs = $logs;
        return $this;
    }
}

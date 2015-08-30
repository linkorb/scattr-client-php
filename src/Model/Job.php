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
    

    private $class;
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
    
    private $key;
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
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
}

<?php

require_once __DIR__ . '/../data/connector.php';

class projectController
{
    private $cm;

    public function __construct()
    {
        $this->cm = new connector();
    }

    public function getMantisProjects()
    {
        return $this->cm->getProjects();
    }
}

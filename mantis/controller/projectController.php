<?php

require_once __DIR__ . '/../data/connector.php';
require_once __DIR__ . '/../model/Project.php';

class projectController
{
    private $cm;

    public function __construct()
    {
        $this->cm = new connector();
    }

    public function getMantisProjects()
    {
        $result = array();
        $arrayMantisProjects = $this->cm->getProjects();
        foreach($arrayMantisProjects as $projectFromArray) {
            $project = new Project();
            $project->setId($projectFromArray['id']);
            $project->setName(utf8_encode($projectFromArray['name']));

            $result[] = $project;
        }

        return $result;
    }
}

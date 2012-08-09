<?php

require_once(MANTIS2ZENDESK_ROOT . '/mantis/data/connector.php');

class projectController
{
    private $cm;
    public function __construct() {
        $this->cm = new connectMantis();
    }

    public function getMantisProjects()
    {
        $arrayProjects = $this->cm->getProjects();
        return $arrayProjects;
    }
}

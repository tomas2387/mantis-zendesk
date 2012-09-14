<?php
class FakeConnector
{
    private $arrayReturn;

    function __construct($array = NULL) {
        if( ! is_null($array) ) {
            $this->arrayReturn = $array;
        }
        else {
            $this->arrayReturn = array(
                array(
                    'id' => 1,
                    'project' => "ProjectName",
                    'category' => "Bugs",
                    'priority' => "Alta",
                    'severity' => "High",
                    'status' => "Open",

                    'reporter' => array(
                        'name' => 'Pepito'
                    ),

                    'summary' => "No me funciona el extintor",
                    "version" => "",
                    "build" => "",
                    "platform" => "",
                    "os" => "",
                    "description" => "Si pongo boca a bajo el extintor no me funciona"

                ),
                array(
                    'id' => 2,
                    'view_state' => "state",
                    'last_updated' => "321312",
                    'project' => "ProjectName",
                    'category' => "Bugs",
                    'priority' => "Alta",
                    'severity' => "High",
                    'status' => "Open",

                    'reporter' => array(
                        'name' => 'Caio'
                    ),

                    'summary' => "Estoy en brasil",
                    "version" => "",
                    "build" => "",
                    "platform" => "",
                    "os" => "",
                    "description" => "O pais mais grande du mundo"
                )
            );
        }
    }

    function getIssuesByProjectId($projectId)
    {
        return $this->arrayReturn;
    }
}


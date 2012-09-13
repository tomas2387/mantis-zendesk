<?php

class bugListView
{
    private $projectId;
    private $arrayMantisReporters;
    private $arrayZendeskReporters;
    private $arrayMantisBugs;

    function __construct($projectId, $arrayMantisReporters, $arrayZendeskReporters, $arrayMantisBugs) {
        $this->projectId = $projectId;
        $this->arrayMantisReporters = $arrayMantisReporters;
        $this->arrayZendeskReporters = $arrayZendeskReporters;
        $this->arrayMantisBugs = $arrayMantisBugs;
    }

    function renderView()
    {
        if( empty($this->projectId)) {
            throw new Exception('Bug List View needs a project id');
        }

        if( empty($this->arrayMantisReporters)) $this->arrayMantisReporters = array();
        if( empty($this->arrayZendeskReporters)) $this->arrayZendeskReporters = array();
        if( empty($this->arrayMantisBugs)) $this->arrayMantisBugs = array();

        $result  = '<script src="resources/js/index.js"></script>';
        $result .= '<form action="index.php?migrate='.$this->projectId.'" method="POST">';

        $usersMapping = $this->getUsersMapping();
        $bugList = $this->getBugList();

        $result .= $usersMapping.$bugList.'<button type="submit" id="migrate">Move all to Zendesk</button></form>';

        return $result;
    }

    private function getBugList() {
        $bugList  = '<div class="block">';
        $bugList .= '<div class="title2">Bug List</div>';
        foreach($this->arrayMantisBugs as $bug)
            $bugList .= $bug->renderView();

        $bugList .= '</div>';

        return $bugList;
    }

    private function getUsersMapping()
    {
        $usersMapping  = '<div class="block">';
        $usersMapping .= '<div class="title2">Users Mapping</div>';

        $usersMapping .= '<div>';
        foreach($this->arrayMantisReporters as $MantisUser) {
            $usersMapping .= '<div>';

            $usersMapping .= 'The mantis user ';
            $usersMapping .= '<span style="color: gray; font-weight: bold">"'.$MantisUser->getName().'"</span>';
            $usersMapping .= ' in Zendesk is going to be <img src="resources/images/icons/arrow_right.png" style="position: relative; top: 3px;">';

            $usersMapping .= $this->getSelectMapping($MantisUser);

            $usersMapping .= '</div>';
        }
        $usersMapping .= '</div>';
        
        $usersMapping .= '</div>';

        return $usersMapping;
    }

    private function getSelectMapping($MantisUser)
    {
        $selectMapping = '<select name="'.$MantisUser->getName().'">';
        foreach($this->arrayZendeskReporters as $ZendeskUser) {
            $selectMapping .= '<option value="'.$ZendeskUser->getId().'">'.$ZendeskUser->getName().'</option>';
        }
        $selectMapping .= '</select>';

        return $selectMapping;
    }
}

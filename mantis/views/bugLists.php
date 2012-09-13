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

        $result = '<script src="resources/js/index.js"></script><form action="index.php?migrate='.$this->projectId.'" method="POST">';

        $usersMapping = '<div class="block"><div class="title2"><span>Users Mapping</span></div><div>';
        foreach($this->arrayMantisReporters as $MantisUser) {
            $usersMapping .= '<div><span>The mantis user <span style="color: gray; font-weight: bold">"'.$MantisUser.'"</span> in Zendesk is going to be <img src="resources/images/icons/arrow_right.png" style="position: relative; top: 3px;"></span>';

            $selectMapping = '<select name="'.$MantisUser.'">';
            foreach($this->arrayZendeskReporters as $ZendeskUser) {
                $selectMapping .= '<option value="'.$ZendeskUser->id.'">'.$ZendeskUser->name.'</option>';
            }
            $selectMapping .= '</select>';

            $usersMapping .= $selectMapping . '</div>';
        }
        $usersMapping .= '</div></div>';

        $bugList = '<div class="block"><div class="title2"><span>Bug List</span></div>';
        foreach($this->arrayMantisBugs as $bug) {
            $bugList .= '<div class="bug"><span class="number">'.$bug['id'].'</span><span class="summary" title="description">'.$bug['summary'].'</span>';
            $bugList .= '<div class="masdatos hidden"><div><span class="bolded-text">Description:</span>'.$bug['description'].'</div>';
            $bugList .= '<div><span class="bolded-text">Reporter:</span>'.$bug['reporter']['name'].'</div></div></div>';
        }
        $bugList .= '</div>';
        $result .= $usersMapping.$bugList.'<button type="submit" id="migrate">Move all to Zendesk</button></form>';

        return $result;
    }
}

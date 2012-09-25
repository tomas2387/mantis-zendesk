<?php

require_once __DIR__ . '/../../mantis/data/mantisWrapper.php';

class fakesoapclient {
    public function call($what, $parametersArray) {
        switch($what) {
            case 'mc_project_get_id_from_name':
                if(!isset($parametersArray['username'])) {
                    return array();
                }
                else if(!isset($parametersArray['password'])) {
                    return array();
                }
                else if(!isset($parametersArray['project_name'])) {
                    return array();
                }

                return array();
            break;
            case 'mc_project_get_issues':

            break;
            case 'mc_projects_get_user_accessible':

            break;
            default:

            break;
        }

    }
}


class mantisWrapperTest extends PHPUnit_Framework_TestCase
{
    public function test_getProjectIdFromName_withEmptyProjectName()
    {
        $mantisWrapper = new mantisWrapper(new fakesoapclient());
        $this->assertEquals($mantisWrapper->getProjectIdFromName(NULL), array());
    }

    /**
    * method: testProjectIdFromName
    * when: calledwithcorrectparameters
    * with:
    * should: returnCorrect
    */
    public function test_testProjectIdFromName_calledwithcorrectparameters__returnCorrect()
    {
        $mantisWrapper = new mantisWrapper(new fakesoapclient());

        $expected = array();

        $this->assertEquals($mantisWrapper->getProjectIdFromName("EquipoSupport"), $expected);
    }
    
    /**
    * method: getProjectIssues
    * when: calledWithCorrectParameters
    * with: 
    * should: ReturnIssuesFromMantis
    */
    public function test_getProjectIssues_calledWithCorrectParameters__ReturnIssuesFromMantis()
    {
        /*
        $mantisWrapper = new mantisWrapper();
        $actual = $mantisWrapper->getProjectIssues(2);
        $expected = array();

        $this->assertEquals($expected, $actual);
        */
    }
}
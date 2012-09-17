<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 12/09/12
 * Time: 15:56
 * To change this template use File | Settings | File Templates.
 */
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
    protected function setUp()
    {

    }

    public function test_getProjectIdFromName_withEmptyProjectName()
    {
        $mantisWrapper = new mantisWrapper(new fakesoapclient());
        $this->assertEquals($mantisWrapper->getProjectIdFromName(NULL), array());
    }
}
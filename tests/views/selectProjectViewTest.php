<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 31/08/12
 * Time: 12:35
 * To change this template use File | Settings | File Templates.
 */

require_once "../../mantis/Item.php";
require_once "../../mantis/views/selectProject.php";


class selectProjectViewTest extends PHPUnit_Framework_TestCase
{


    private $baseHtmlExpected = '<script src="resources/js/index.js"></script>

        <div class="title">Select the Mantis Project</div>
        <div>Check the settings.php file to set correctly your mantis endpoint and zendesk API Key</div>
        <div></div>
        <form class="form" action="" method="get">
            <input type="hidden" name="bugList" value="">';


    private function pushProject($array, $id, $name)
    {
        $project['id'] = $id;
        $project['name'] = $name;
        array_push($array, $project);
        return $array;
    }


    private function verifyRenderView($array, $expected)
    {
        $view = new selectProjectView($array);
        $actual = $view->renderView();
        $this->assertEquals($expected, $actual);
    }


    /**
     * dataProvider getTestData */
    public function getTestData()
    {
        $array = array();
        $array = $this->pushProject($array, "1", "a bug");
        $array = $this->pushProject($array, "2", "another bug");
        return array(
            array($array, $this->baseHtmlExpected .
                '<select name="project"> <option value = "1" >a bug</option><option value = "2" >another bug</option> </select><input type="submit" value = "Next"></form><div class="errormessage hidden"></div>'),
            array(array(), $this->baseHtmlExpected .
                '<select name="project">  </select><input type="submit" value = "Next"></form><div class="errormessage hidden"></div>'),
            array(NULL, $this->baseHtmlExpected .
                '<select name="project">  </select><input type="submit" value = "Next"></form><div class="errormessage hidden"></div>'),
        );
    }


    /**
     * method: renderView
     * when: called
     * with:
     * should: correctAnswer
     * @dataProvider getTestData
     */
    public function test_renderView_called__correctAnswer($array, $expected)
    {
        $this->verifyRenderView($array, $expected);
    }


}
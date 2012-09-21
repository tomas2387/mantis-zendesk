<?php
require_once __DIR__ . "/../../mantis/Item.php";
require_once __DIR__ . "/../../mantis/views/selectProject.php";


class selectProjectViewTest extends PHPUnit_Framework_TestCase
{


    private $baseHtmlExpected = '<script src="resources/js/index.js"></script>

        <div class="title">Select the Mantis Project</div>
        <div>Check the settings.php file to set correctly your mantis endpoint and zendesk API Key</div>
        <div></div>
        <form class="form" action="" method="get">
            <input type="hidden" name="bugList" value=""><div><select name="project">';


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
        $array = $this->pushProject($array, "1", "a project");
        $array = $this->pushProject($array, "2", "another project");
        return array(
            array($array, $this->baseHtmlExpected .
                '<option value = "1" >a project</option>' .
                '<option value = "2" >another project</option>' .
                '</select>' .
                '<input type="submit" value = "Next">' .
                '</div><div>' .
                '<input id="openissues" name="openissues" value="true" type="checkbox" checked="checked">' .
                '<label for="openissues">I want to migrate only new mantis bugs</label>' .
                '</div></form><div class="errormessage hidden"></div>'),
            array(array(), $this->baseHtmlExpected .
                '</select><input type="submit" value = "Next"></div><div><input id="openissues" name="openissues" value="true" type="checkbox" checked="checked"><label for="openissues">I want to migrate only new mantis bugs</label></div></form><div class="errormessage hidden"></div>'),
            array(NULL, $this->baseHtmlExpected .
                '</select><input type="submit" value = "Next"></div><div><input id="openissues" name="openissues" value="true" type="checkbox" checked="checked"><label for="openissues">I want to migrate only new mantis bugs</label></div></form><div class="errormessage hidden"></div>'),
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
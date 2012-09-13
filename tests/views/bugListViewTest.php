<?php

require_once '../../mantis/views/bugLists.php';

/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 10/09/12
 * Time: 9:56
 * To change this template use File | Settings | File Templates.
 */
class bugListViewTest extends PHPUnit_Framework_TestCase
{
    private $baseHeadHtmlExpected = '<script src="resources/js/index.js"></script><form action="index.php?migrate=1" method="POST"><div class="block"><div class="title2">Users Mapping</div>';
    private $baseFooterHtmlExpected = '<button type="submit" id="migrate">Move all to Zendesk</button></form>';

    private function verify($instance,$expected) {
        $actual = $instance->renderView();
        $this->assertEquals($actual, $expected);
    }

    /**
    * method: renderView
    * when: calledWithNULLS
    * with:
    * should: returnCorrectAnswer
    */
    public function test_renderView_calledWithNULLS__returnCorrectAnswer()
    {
        $instance = new bugListView(1, NULL, NULL, NULL);
        $expected  = $this->baseHeadHtmlExpected;
        $expected .= '<div></div></div>';
        $expected .= '<div class="block"><div class="title2">Bug List</div></div>';
        $expected .= $this->baseFooterHtmlExpected;

        $this->verify($instance, $expected);
    }

    /**
     * method: renderView
     * when: calledWithInCorrectParameters
     * with:
     * should: returnError
     */
    public function test_renderView_calledWithInCorrectParameters__returnError()
    {
        $arrayMantisReporters = array();
        $arrayZendeskReporters = array();
        $arrayMantisBugs = array();

        $instance = new bugListView(1, $arrayMantisReporters, $arrayZendeskReporters, $arrayMantisBugs);
        $expected  = $this->baseHeadHtmlExpected;

        $expected .= '<div>';
        $expected .= '';
        $expected .= '</div>';

        $expected .= '</div>';
        $expected .= '<div class="block"><div class="title2">Bug List</div></div>';
        $expected .= $this->baseFooterHtmlExpected;

        $this->verify($instance, $expected);
    }
}

<?php

require_once __DIR__ . '/../../mantis/views/bugLists.php';

class bugListViewTest extends PHPUnit_Framework_TestCase
{
    private $baseHeadHtmlExpected = '<script src="resources/js/index.js"></script><form action="index.php?migrate=1" method="POST"><div class="block"><div class="title2"><span>Users Mapping</span></div>';
    private $baseFooterHtmlExpected = '<button type="submit" id="migrate">Move all to Zendesk</button></form>';

    private $bugListView;

    private function verify($instance,$expected) {
        $actual = $instance->renderView();
        $this->assertEquals($actual, $expected);
    }

    public function setUp() {
        $this->bugListView = new bugListView();
    }


    /**
    * method: renderView
    * when: calledWithNULLS
    * with:
    * should: returnCorrectAnswer
    */
    public function test_renderView_calledWithNULLS__returnCorrectAnswer()
    {
        $this->bugListView->setProjectId(1);
        $expected  = $this->baseHeadHtmlExpected;
        $expected .= '<div></div></div>';
        $expected .= '<div class="block"><div class="title2"><span>Bug List</span></div></div>';
        $expected .= $this->baseFooterHtmlExpected;

        $this->verify($this->bugListView, $expected);
    }

    /**
     * method: renderView
     * when: calledWithInCorrectParameters
     * with:
     * should: returnError
     */
    public function test_renderView_calledWithInCorrectParameters__returnError() {
        $arrayMantisReporters = array();
        $arrayZendeskReporters = array();
        $arrayMantisBugs = array();

        $this->bugListView->setProjectId(1);
        $this->bugListView->setArrayMantisReporters($arrayMantisReporters);
        $this->bugListView->setArrayZendeskReporters($arrayZendeskReporters);
        $this->bugListView->setArrayMantisBugs($arrayMantisBugs);

        $expected  = $this->baseHeadHtmlExpected;

        $expected .= '<div>';
        $expected .= '';
        $expected .= '</div>';

        $expected .= '</div>';
        $expected .= '<div class="block"><div class="title2"><span>Bug List</span></div></div>';
        $expected .= $this->baseFooterHtmlExpected;

        $this->verify($this->bugListView, $expected);
    }
}

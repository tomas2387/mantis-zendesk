<?php

require_once __DIR__ . '/../../src/views/bugLists.php';
require_once __DIR__ . '/../../src/model/Bug.php';
require_once __DIR__ . '/../../src/model/Reporter.php';

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


    private function createBug($id, $summary, $description, $reporterName) {
        $bug = new Bug();
        $bug->setId($id);
        $bug->setDescription($description);
        $bug->setSummary($summary);

        $reporter = new Reporter();
        $reporter->setName($reporterName);
        $bug->setReporter($reporter);

        return $bug;
    }

    /**
    * method: renderView
    * when: calledwithcorrectparameters
    * with:
    * should: returncorrectbuglist
    */
    public function test_renderView_calledwithcorrectparameters__returncorrectbuglist()
    {

        $bug1 = $this->createBug(1, "hola", "adios", "Pepe");

        $arrayMantisReporters = array();
        $arrayZendeskReporters = array();
        $arrayMantisBugs = array($bug1);

        $this->bugListView->setProjectId(1);
        $this->bugListView->setArrayMantisReporters($arrayMantisReporters);
        $this->bugListView->setArrayZendeskReporters($arrayZendeskReporters);
        $this->bugListView->setArrayMantisBugs($arrayMantisBugs);

        $expected  = $this->baseHeadHtmlExpected;

        $expected .= '<div>';
        $expected .= '';
        $expected .= '</div>';

        $expected .= '</div>';
        $expected .= '<div class="block"><div class="title2"><span>Bug List</span></div>';
        $expected .= '<div class="bug"><span class="number">1</span><span class="summary" title="description">hola</span>';
        $expected .= '<div class="masdatos hidden"><div><span class="bolded-text">Description:</span>adios</div>';
        $expected .= '<div><span class="bolded-text">Reporter:</span>Pepe</div></div></div>';

        $expected .= '</div>';
        $expected .= $this->baseFooterHtmlExpected;

        $this->verify($this->bugListView, $expected);
    }
}

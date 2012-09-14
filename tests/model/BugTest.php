<?php
require_once dirname(__FILE__) . "/../../mantis/Item.php";
require_once dirname(__FILE__) . "/../../mantis/model/Bug.php";
require_once dirname(__FILE__) . "/../../mantis/model/Reporter.php";

class BugTest extends PHPUnit_Framework_TestCase
{
    /**
    * method: renderView
    * when: called
    * with:
    * should: returnCorrectHtml
    */
    public function test_renderView_called__returnCorrectHtml()
    {
        $expected  = '<div class="bug"><span class="number">1</span>';
        $expected .= '<span class="summary" title="description">This is a bug from mantis</span>';
        $expected .= '<div class="masdatos hidden">';
        $expected .= '<div><span class="bolded-text">Description:</span>A bug from mantis and we want to pass it to zendesk</div>';
        $expected .= '<div><span class="bolded-text">Reporter:</span>Tomas Prado</div></div></div>';

        $bug = new Bug();
        $bug->setId(1);
        $bug->setSummary("This is a bug from mantis");
        $bug->setDescription("A bug from mantis and we want to pass it to zendesk");

        $reporter = new Reporter();
        $reporter->setName("Tomas Prado");
        $bug->setReporter($reporter);

        $actual = $bug->renderView();

        $this->assertEquals($expected, $actual);
    }


    /**
    * method: renderView
    * when: NullParameters
    * with:
    * should: ReturnNothing
    */
    public function test_renderView_NullParameters__ReturnNothing(){
        $expected  = "";

        $bug = new Bug();
        $actual = $bug->renderView();

        $this->assertEquals($expected, $actual);
    }

    /**
    * method: renderView
    * when: BugHasAnIDbutNoParameters
    * with:
    * should: ReturnTheBugOnlywiththeexistingParameters
    */
    public function test_renderView_BugHasAnIDbutNoParameters__ReturnTheBugOnlywiththeexistingParameters()
    {
        $expected  = '<div class="bug"><span class="number">1</span><div class="masdatos hidden"><div>No data for description</div><div>No data for Reporter</div></div></div>';

        $bug = new Bug();
        $bug->setId(1);
        $actual = $bug->renderView();

        $this->assertEquals($expected, $actual);
    }
}

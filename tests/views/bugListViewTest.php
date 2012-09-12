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
    private $baseHeadHtmlExpected = '<script src="resources/js/index.js"></script>';
    private $baseFooterHtmlExpected = '<button type="submit" id="migrate">Move all to Zendesk</button></form>';

    /**
    * method: renderView
    * when: called
    * with:
    * should: returnCorrectAnswer
    */
    public function test_renderView_called__returnCorrectAnswer()
    {
        $instance = new bugListView();
        $expected = $instance->renderView(1, NULL, NULL, NULL);
        $actual = $this->baseHeadHtmlExpected.'<form action="index.php?migrate=1" method="POST"><div class="block"><div class="title2"><span>Users Mapping</span></div><div></div></div><div class="block"><div class="title2"><span>Bug List</span></div></div>'.$this->baseFooterHtmlExpected;
        $this->assertEquals($actual, $expected);
    }



}

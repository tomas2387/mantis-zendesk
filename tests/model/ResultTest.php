<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 25/09/12
 * Time: 10:26
 */
require_once __DIR__ . '/../../mantis/model/Bug.php';
require_once __DIR__ . '/../../mantis/model/Result.php';
require_once __DIR__ . '/../../mantis/model/Reporter.php';

class ResultTest extends PHPUnit_Framework_TestCase
{

    /**
    * method: RenderView
    * when: CalledWithCorrectParameters
    * with:
    * should: ReturnCorrectHtml
    */
    public function test_RenderView_CalledWithCorrectParameters__ReturnCorrectHtml()
    {
        $result = new Result();
        $result->id = 0;
        $result->text = "Error on the ticket number 1: Base Description: cannot be blank";

        $ticket = new Bug();
        $ticket->setId(1);
        $ticket->setSummary("Hola");
        $ticket->setDescription("Descirption");

        $reporter = new Reporter();
        $reporter->setName("Tomas");
        $reporter->setEmail("tomas2387@gmail.com");
        $ticket->setReporter($reporter);

        $result->ticket = $ticket;

        $actual = $result->renderView();

        $expected = "<div><div>Error on the ticket number 1: Base Description: cannot be blank</div><div>".$ticket->renderView()."</div></div>";

        $this->assertEquals($expected, $actual);
    }

}
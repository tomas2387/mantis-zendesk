<?php
require_once __DIR__ . "/../../mantis/Item.php";
require_once __DIR__ . "/../../mantis/views/migrate.php";
require_once __DIR__ . "/../../mantis/model/Result.php";
require_once __DIR__ . "/../../mantis/model/Bug.php";
require_once __DIR__ . "/../../mantis/model/Reporter.php";


class migrateTest extends PHPUnit_Framework_TestCase
{

    protected function createResult($id, $text, $ticketNumber, $ticketSummary, $ticketDescription, $reporterName, $reporterEmail) {
        $result = new Result();
        $result->id = $id;
        $result->text = $text;

        $ticket = new Bug();
        $ticket->setId($ticketNumber);
        $ticket->setSummary($ticketSummary);
        $ticket->setDescription($ticketDescription);

        $reporter = new Reporter();
        $reporter->setName($reporterName);
        $reporter->setEmail($reporterEmail);
        $ticket->setReporter($reporter);

        $result->ticket = $ticket;

        return $result;
    }


    /**
     * method: renderView
     * when: idEqualsOne
     * with:
     * should: returnCorrect
     */
    public function test_renderView_idEqualsOne__returnCorrect()
    {
        $result = $this->createResult(1,
            "Error on the ticket number 1: Base Description: cannot be blank",
            1,
            "Hola",
            "Descirption",
            "Tomas",
            "tomas2387@gmail.com");
        $shouldResult = '<div class="title">Done</div><div>'.$result->renderView().'</div>';

        $this->verifyRenderView($result, $shouldResult);
    }



    /**
     * method: renderView
     * when: idEqualsZero
     * with:
     * should: returnError
     */
    public function test_renderView_idEqualsZero__returnError()
    {

        $result = new Result();
        $result->id = 0;
        $shouldResult = '<div class="title">Done</div><div>' . $result->renderView() . '</div>';
        $this->verifyRenderView($result, $shouldResult);
    }

    /**
     * method: renderView
     * when: idNull
     * with:
     * should: returnError
     */
    public function test_renderView_idNull__returnError()
    {
        $result = new Result();
        $result->id = NULL;

        $shouldResult = '<div class="title">Done</div><div><div><div>' . $result->text . '</div><div></div></div></div>';

        $this->verifyRenderView($result, $shouldResult);
    }

    /**
     * method: renderView
     * when: resultNULL
     * with:
     * should: returnError
     */
    public function test_renderView_resultNULL__returnError()
    {
        $result = NULL;

        $shouldResult = '<div class="title">Fatal Error</div><div>No results on the migration (maybe no issues were migrated?)</div>';

        $this->verifyRenderView($result, $shouldResult);
    }

    private function verifyRenderView($result, $shouldResult)
    {
        $migrateView = new migrateView();
        $migrateView->addResult($result);
        $this->assertEquals($shouldResult, $migrateView->renderView());
    }
}




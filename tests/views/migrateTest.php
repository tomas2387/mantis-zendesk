<?php
require_once __DIR__ . "/../../mantis/Item.php";
require_once __DIR__ . "/../../mantis/views/migrate.php";
require_once __DIR__ . "/../../mantis/model/Result.php";


class migrateTest extends PHPUnit_Framework_TestCase
{
    private function verifyRenderView($result, $expected)
    {
        $view = new migrateView($result);
        $actual = $view->renderView();
        $this->assertEquals($actual, $expected);
    }

    /**
     * method: renderView
     * when: idEqualsOne
     * with:
     * should: returnCorrect
     */
    public function test_renderView_idEqualsOne__returnCorrect()
    {

        $result = new Result();
        $result->id = 1;

        $shouldResult = '<div class="title">Done</div><div>Bugs correctly migrated to Zendesk</div>';
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

        $shouldResult = '<div class="title">Done</div><div>There was an error</div><div>' . $result->text . '</div>';

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

        $shouldResult = '<div class="title">Done</div><div>There was an error</div><div>' . $result->text . '</div>';

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
        $shouldResult = '<div class="title">Done</div><div>There was an error</div><div></div>';

        $this->verifyRenderView($result, $shouldResult);
    }
}




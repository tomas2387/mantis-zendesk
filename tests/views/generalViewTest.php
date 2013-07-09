<?php

require_once __DIR__ . '/../../src/views/generalView.php';
require_once __DIR__ . '/../../src/Item.php';
require_once __DIR__ . '/../../src/model/Result.php';
require_once __DIR__ . '/../../src/model/Bug.php';
require_once __DIR__ . '/../../src/model/Reporter.php';
require_once __DIR__ . '/../../src/views/migrate.php';

class gereralViewTest extends PHPUnit_Framework_TestCase
{

    /**
     * method: render
     * when: itemNULL
     * with:
     * should: returnEmptyString
     */
    public function test_render_itemNULL__returnEmptyString()
    {
        $this->verifyRender(NULL, "");
    }

    /**
     * method: render
     * when: itemIsArray
     * with:
     * should: return EmptyString
     */
    public function test_render_itemIsArray__returnEmptyString()
    {
        $this->verifyRender(array(), "");
    }

    /**
     * method: render
     * when: itemMigrateView
     * with:
     * should: StringHtml
     */
    public function test_render_itemMigrateView__StringHtml()
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

        $migrateView = new migrateView();
        $migrateView->addResult($result);

        $html = '<div class="title">Done</div><div><div><div>Error on the ticket number 1: Base Description: cannot be blank</div><div>'.$ticket->renderView().'</div></div></div>';
        $this->verifyRender($migrateView, $html);
    }

    private function verifyRender($migrateView, $expected)
    {
        $gView = new generalView();
        $gView->addItem($migrateView);
        $this->assertEquals($expected, $gView->render());
    }

}

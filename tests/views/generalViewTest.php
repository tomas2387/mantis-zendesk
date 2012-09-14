<?php

require_once __DIR__ . '/../../mantis/views/generalView.php';
require_once __DIR__ . '/../../mantis/Item.php';
require_once __DIR__ . '/../../mantis/model/Result.php';
require_once __DIR__ . '/../../mantis/views/migrate.php';

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
        $html = '<div class="title">Done</div><div>There was an error</div><div></div>';
        $this->verifyRender(new migrateView($result), $html);
    }

    private function verifyRender($param, $actual)
    {
        $gView = new generalView();
        $gView->addItem($param);
        $this->assertEquals($gView->render(), $actual);
    }

}

<?php

require_once '../../mantis/views/generalView.php';
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 13/09/12
 * Time: 11:14
 * To change this template use File | Settings | File Templates.
 */
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
        $gView = new generalView();
        $gView->addItem(NULL);
        $this->assertEquals($gView->render(),"");
    }

}

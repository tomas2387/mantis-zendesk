<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 12/09/12
 * Time: 15:56
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . '/../../mantis/data/mantisWrapper.php';

class mantisWrapperTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {

    }

    public function test_getProjectIdFromName_withEmptyProjectName()
    {
        $mantisWrapper = new mantisWrapper();
        $this->assertEquals($mantisWrapper->getProjectIdFromName(NULL), NULL);
    }
}
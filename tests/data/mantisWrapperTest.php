<?php

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
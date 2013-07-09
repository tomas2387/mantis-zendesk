<?php
require_once __DIR__ . '/../../../src/Providers/Mantis/MantisProvider.php';
require_once __DIR__ . '/../../../resources/library/nusoap/nusoap.php';

class MantisProviderTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    public $mockNuSOAP;

    /**
     * @var MantisProvider
     */
    public $sut;

    public function setUp()
    {
        $this->mockNuSOAP = $this->getMockBuilder('nusoap_client')->disableOriginalConstructor()->getMock();
        $this->sut = new MantisProvider($this->mockNuSOAP);
    }


    /**
    * method: getProjectIdFromName
    * when: called
    * with: null
    * should: throwException
     * @expectedException InvalidArgumentException
    */
    public function test_getProjectIdFromName_called_null_throwException()
    {
        $this->sut->getProjectIdFromName(null);
    }
}
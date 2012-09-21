<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 21/09/12
 * Time: 10:29
 */
require_once __DIR__ . '/../../mantis/data/zendeskWrapper.php';
require_once __DIR__ . '/../../mantis/data/curlWrap.php';

class zendeskWrapperTest extends PHPUnit_Framework_TestCase{

    protected function setUp(){
    }

    /**
    * method: createTickets
    * when: CorrectTicketParameters
    * with:
    * should: ReturnCorrectAnswer
    */
    public function test_createTickets_CorrectTicketParameters__ReturnCorrectAnswer()
    {
        $parameters = array();
       /* $parameters[] = array(
            'ticket' => array(
                'subject' => "Subject ticket",
                'description' => "Description ticket",
                'requester' => array(
                    'name' => "Test",
                    'email' => "tomas2387@gmail.com"
                )
            )
        );*/
        $parameters[] = array(
            'ticket' => array(
                'subject' => "",
                'requester' => array(
                    'name' => "Test",
                    'email' => "tomas2387@gmail.com"
                )
            )
        );

        $stub = $this->getMock('curlWrap',
                                array('curlWrapFunction'));

        $stdClassWithError = new stdClass();
        $stdClassWithError->error = "InvalidArgument";
        $stdClassWithError->details = new stdClass();
        $stdClassWithError->details->base = array();
        $stdClassWithError->details->base[0] = new stdClass();
        $stdClassWithError->details->base[0]->description = "Base Description: cannot be blank";

        $this->assertEquals(true, isset($stdClassWithError->error));

        $stub->expects($this->once())
            ->method('curlWrapFunction')
            ->will($this->returnValue($stdClassWithError));

        $zw = new zendeskWrapper($stub);
        $actual = $zw->createTickets($parameters);

        $expected = array(
            "Error on the ticket NO SUBJECT: Base Description: cannot be blank"
        );
        $this->assertEquals($expected, $actual);
    }
}
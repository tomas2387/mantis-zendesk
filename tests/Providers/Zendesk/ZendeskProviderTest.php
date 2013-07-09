<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 21/09/12
 * Time: 10:29
 */
require_once __DIR__ . '/../../../src/Providers/Zendesk/ZendeskProvider.php';
require_once __DIR__ . '/../../../src/Providers/curlWrap.php';

require_once __DIR__ . '/../../../src/model/Bug.php';
require_once __DIR__ . '/../../../src/model/Reporter.php';
require_once __DIR__ . '/../../../src/model/Result.php';

class ZendeskProviderTest extends PHPUnit_Framework_TestCase
{
    /**
    * method: createTickets
    * when: InCorrectTicketParameters
    * with:
    * should: ReturnCorrectAnswer
    */
    public function test_createTickets_InCorrectTicketParameters__ReturnCorrectAnswer()
    {
        $parameters = array(
            array(
                    'ticket' => array(
                        'subject' => "",
                        'requester' => array(
                            'name' => "Test",
                            'email' => "tomas2387@gmail.com"
                        )
                    )
            )
        );

        $stub = $this->getMock('curlWrap', array('curlWrapFunction'));

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

        $zw = new ZendeskProvider($stub);
        $actual = $zw->createTickets($parameters);


        $zendeskIssue = new Bug();
        $zendeskIssue->setId(1);

        $reporter = new Reporter();
        $reporter->setName("Test");
        $reporter->setEmail("tomas2387@gmail.com");
        $zendeskIssue->setReporter($reporter);

        $result = new Result();
        $result->id = 0;
        $result->text = "Error on the ticket number 1: Base Description: cannot be blank";
        $result->ticket = $zendeskIssue;
        $expected = array(
            $result
        );
        $this->assertEquals($expected, $actual);
    }
}
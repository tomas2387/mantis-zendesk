<?php
require_once __DIR__ . '/../../mantis/controller/userController.php';
require_once __DIR__ . '/FakeConector.php';


class userControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * method: getMantisReporters
     * when: EmptyProjectId
     * with:
     * should: returnEmptyArray
     */
    public function test_getMantisReporters_withEmptyProjectId_returnEmptyArray()
    {
        $reporter1 = new Reporter();
        $reporter1->setName('Pepito');

        $reporter2 = new Reporter();
        $reporter2->setName('Caio');

        $expected = array($reporter1, $reporter2);

        $fc = new FakeConector();
        $usercontroller = new userController($fc);
        $this->assertEquals($usercontroller->getMantisReporters(NULL), $expected);
    }

    /**
    * method: getZendeskReporters
    * when: xx
    * with:
    * should: returnArrayUsersWithEmail
    */
    public function test_getZendeskReporters_xx__returnArrayUsersWithEmail(){
        $fc = new FakeConector();
        $expected = $fc->getZendeskReporters();
        $userController = new userController();
        $this->assertEquals($userController->getZendeskReporters(), $expected);
    }

    /**
    * method: getThisZendeskReporter
    * when: userZendeskIdIsNULL
    * with:
    * should:
    */
    /*public function test_getThisZendeskReporter___(){
        $fc = new FakeConector();
        $expected = $fc->getThisZendeskReporter();
        $userController = new userController($fc);
        $this->assertEquals($userController->getThisZendeskReporter(NULL), $expected);
    }*/
}
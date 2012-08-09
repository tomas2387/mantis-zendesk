<?php
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/userController.php');
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/bugsController.php');

$uc = new userController();
$arrayMantisReporters = $uc->getMantisReporters($_GET['bugList']);
$arrayZendeskReporters = $uc->getZendeskReporters();

$bc = new bugsController();
$arrayMantisBugs = $bc->getMantisBugs();

include(MANTIS2ZENDESK_ROOT.'/resources/header.html');
include(MANTIS2ZENDESK_ROOT.'/mantis/views/bugLists.php');
include(MANTIS2ZENDESK_ROOT.'/resources/footer.html');
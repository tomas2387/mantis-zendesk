<?php
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/userController.php');
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/bugsController.php');

$uc = new userController();
$arrayMantisReporters = $uc->getMantisReporters($_GET['project']);
$arrayZendeskReporters = $uc->getZendeskReporters();

$bc = new bugsController();
$arrayMantisBugs = $bc->getMantisBugs($_GET['project']);

include(MANTIS2ZENDESK_ROOT.'/resources/header.html');
include(MANTIS2ZENDESK_ROOT.'/mantis/views/bugLists.php');
include(MANTIS2ZENDESK_ROOT.'/resources/footer.html');
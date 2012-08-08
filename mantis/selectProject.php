<?php
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/projectController.php');

$uc = new projectController();
$arrayMantisProjects = $uc->getMantisProjects();

include(MANTIS2ZENDESK_ROOT.'/resources/header.html');
include(MANTIS2ZENDESK_ROOT.'/mantis/views/selectProject.php');
include(MANTIS2ZENDESK_ROOT.'/resources/footer.html');
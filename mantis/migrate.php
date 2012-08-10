<?php
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/bugsController.php');

$bc = new bugsController();

var_dump($_POST);

include(MANTIS2ZENDESK_ROOT.'/resources/header.html');
include(MANTIS2ZENDESK_ROOT.'/mantis/views/migrate.php');
include(MANTIS2ZENDESK_ROOT.'/resources/footer.html');
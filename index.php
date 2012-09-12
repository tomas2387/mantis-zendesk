<?php
define( '__ROOT__', dirname(dirname(__FILE__)) );
define( 'MANTIS2ZENDESK_ROOT', __ROOT__.'/mantis-zendesk' );

require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/userController.php');
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/bugsController.php');


$uc = new projectController();
$arrayMantisProjects = $uc->getMantisProjects();


if( empty($_GET) ) {
    $view = new selectProjectView();
    $view->renderView($arrayMantisProjects);
}
else if( isset($_GET['bugList']) ) {
    $uc = new userController();
    $arrayMantisReporters = $uc->getMantisReporters($_GET['project']);
    $arrayZendeskReporters = $uc->getZendeskReporters();

    $bc = new bugsController();
    $arrayMantisBugs = $bc->getMantisBugs($_GET['project']);

    $view = new bugListView();
    $view->renderView($_GET['bugList'], $arrayMantisReporters, $arrayZendeskReporters, $arrayMantisBugs);
}
else if( isset($_GET['migrate']) ) {

    $view = new migrateView();
    $view->
    require_once(MANTIS2ZENDESK_ROOT.'/mantis/migrate.php');
}
else {
    require_once(MANTIS2ZENDESK_ROOT.'/resources/error404.html');
}

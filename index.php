<?php
define( '__ROOT__', dirname(dirname(__FILE__)) );
define( 'MANTIS2ZENDESK_ROOT', __ROOT__.'/mantis-zendesk' );

require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/projectController.php');
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/userController.php');
require_once(MANTIS2ZENDESK_ROOT.'/mantis/controller/bugsController.php');



if( empty($_GET) ) {
    $uc = new projectController();
    $arrayMantisProjects = $uc->getMantisProjects();

    $view = new selectProjectView();
    $html = $view->renderView($arrayMantisProjects);
}
else if( isset($_GET['bugList']) ) {
    $uc = new userController();
    $arrayMantisReporters = $uc->getMantisReporters($_GET['project']);
    $arrayZendeskReporters = $uc->getZendeskReporters();

    $bc = new bugsController();
    $arrayMantisBugs = $bc->getMantisBugs($_GET['project']);

    $view = new bugListView();
    $html = $view->renderView($_GET['bugList'], $arrayMantisReporters, $arrayZendeskReporters, $arrayMantisBugs);
}
else if( isset($_GET['migrate']) ) {
    $bc = new bugsController();
    $result = $bc->bugsToZendeskTickets(intval($_GET['migrate']), $_POST);

    $view = new migrateView();
    $html = $view->renderView($result);
}
else {
    $view = new errorView();
    $html = $view->renderView();
}


$gView = new generalView();
$gView->render(file_get_contents('resources/header.html'), $html, file_get_contents('resources/footer.html'));
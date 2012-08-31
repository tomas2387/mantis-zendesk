<?php
define( '__ROOT__', dirname(dirname(__FILE__)) );
define( 'MANTIS2ZENDESK_ROOT', __ROOT__.'/mantis-zendesk' );

$uc = new projectController();
$arrayMantisProjects = $uc->getMantisProjects();


if( empty($_GET) ) {
    $view = new selectProjectView();
    $view->renderView($arrayMantisProjects);
}
else if( isset($_GET['bugList']) ) {
    require_once(MANTIS2ZENDESK_ROOT.'/mantis/bugLists.php');
}
else if( isset($_GET['migrate']) ) {
    require_once(MANTIS2ZENDESK_ROOT.'/mantis/migrate.php');
}
else {
    require_once(MANTIS2ZENDESK_ROOT.'/resources/error404.html');
}

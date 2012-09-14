<?php
require_once __DIR__ . '/mantis/controller/projectController.php';
require_once __DIR__ . '/mantis/controller/userController.php';
require_once __DIR__ . '/mantis/controller/bugsController.php';

require_once __DIR__ . '/mantis/views/selectProject.php';
require_once __DIR__ . '/mantis/views/bugLists.php';
require_once __DIR__ . '/mantis/views/migrate.php';
require_once __DIR__ . '/mantis/views/errorView.php';
require_once __DIR__ . '/mantis/views/generalView.php';


require_once __DIR__ . '/resources/header.php';
require_once __DIR__ . '/resources/footer.php';

if (empty($_GET)) {
    $uc = new projectController();
    $arrayMantisProjects = $uc->getMantisProjects();

    $view = new selectProjectView($arrayMantisProjects);
} else if (isset($_GET['bugList'])) {
    $uc = new userController();
    $arrayMantisReporters = $uc->getMantisReporters($_GET['project']);
    $arrayZendeskReporters = $uc->getZendeskReporters();

    $bc = new bugsController();
    $arrayMantisBugs = $bc->getMantisBugs($_GET['project']);

    $view = new bugListView($_GET['bugList'], $arrayMantisReporters, $arrayZendeskReporters, $arrayMantisBugs);
} else if (isset($_GET['migrate'])) {
    $bc = new bugsController();
    $result = $bc->bugsToZendeskTickets(intval($_GET['migrate']), $_POST);

    $view = new migrateView($result);
} else {
    $view = new errorView();
}

$header = new Header();
$footer = new Footer();

$gView = new generalView();

$gView->addItem($header);
$gView->addItem($view);
$gView->addItem($footer);

echo $gView->render();
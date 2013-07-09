<?php
require_once __DIR__ . '/src/controller/projectController.php';
require_once __DIR__ . '/src/controller/userController.php';
require_once __DIR__ . '/src/controller/bugsController.php';

require_once __DIR__ . '/src/views/selectProject.php';
require_once __DIR__ . '/src/views/bugLists.php';
require_once __DIR__ . '/src/views/migrate.php';
require_once __DIR__ . '/src/views/errorView.php';
require_once __DIR__ . '/src/views/generalView.php';


require_once __DIR__ . '/resources/header.php';
require_once __DIR__ . '/resources/footer.php';

$error = "";
$view = new errorView();
$view->setErrorText($error);

if (empty($_GET)) {
    $uc = new projectController();
    $arrayMantisProjects = $uc->getMantisProjects();

    $view = new selectProjectView($arrayMantisProjects);
} else if (isset($_GET['bugList']) ) {
    if(empty($_GET['project'])) {
        $view->setErrorText("No project specified");
    }
    else {
        $selectOnlyOpenIssues = isset($_GET['openissues']) ? true : false;

        $uc = new userController();
        $arrayMantisReporters = $uc->getMantisReporters($_GET['project']);
        $arrayZendeskReporters = $uc->getZendeskReporters();

        $bc = new bugsController();
        $arrayMantisBugs = $bc->getMantisBugs($_GET['project'], $selectOnlyOpenIssues);

        $view = new bugListView();
        $view->setProjectId($_GET['project']);
        $view->setArrayMantisReporters($arrayMantisReporters);
        $view->setArrayZendeskReporters($arrayZendeskReporters);
        $view->setArrayMantisBugs($arrayMantisBugs);
    }
} else if (isset($_GET['migrate'])) {
    $bc = new bugsController();

    $ArrayOfResults = $bc->bugsToZendeskTickets(intval($_GET['migrate']), $_POST);

    $view = new migrateView();
    $view->setArrayResults($ArrayOfResults);
}

$header = new Header();
$footer = new Footer();

$gView = new generalView();

$gView->addItem($header);
$gView->addItem($view);
$gView->addItem($footer);

echo $gView->render();
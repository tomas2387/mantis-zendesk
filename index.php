<?php
define('__ROOT__', dirname(dirname(__FILE__)));
define('MANTIS2ZENDESK_ROOT', __ROOT__.'/mantis-zendesk');

if( empty($_GET) ) {
    require_once(MANTIS2ZENDESK_ROOT.'/mantis/selectProject.php');
}
else {
    if( isset($_GET['bugList']) ) {
        require_once(MANTIS2ZENDESK_ROOT.'/mantis/bugLists.php');
    }
}

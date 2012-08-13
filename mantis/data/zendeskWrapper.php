<?php
require_once(MANTIS2ZENDESK_ROOT . '/settings.php');

class zendeskWrapper {
    public function __construct() {

    }

    public function getUsers() {
        return $this->curlWrap('/users.json', NULL, "GET");
    }

    private function curlWrap($url, $json, $action)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, ZDURL . $url);

        curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
        switch($action){
            case "POST":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            default:
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        //FOR DEBUGGING
        $fh = fopen(MANTIS2ZENDESK_ROOT . '/curl.log', 'w');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_STDERR, $fh);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);

        return $decoded;
    }

    public function getUser($userZendeskId)
    {
        if(empty($userZendeskId) || ! isset($userZendeskId)) {
            return NULL;
        }
        return $this->curlWrap('/users/'.$userZendeskId.'.json', NULL, "GET"); //https://eyeos.zendesk.com/api/v2/users/225430796.json
    }

    public function createTickets($ZendeskTicketsObjects)
    {
        if(empty($ZendeskTicketsObjects) || ! isset($ZendeskTicketsObjects) || ! is_array($ZendeskTicketsObjects)) {
            return NULL;
        }

        $responses = array();
        foreach($ZendeskTicketsObjects as $ticket) {
            $responses[] = $this->curlWrap("/tickets.json", json_encode($ticket, JSON_FORCE_OBJECT), "POST");
        }

        return $responses;
    }
}
<?php
require_once __DIR__ . '/curlWrap.php';

class zendeskWrapper
{
    private $curlWrap;
    public function __construct($curlWrap = null)
    {
        if(is_null($curlWrap)) {
            $this->curlWrap = new curlWrap();
        }
        else {
            $this->curlWrap = $curlWrap;
        }
    }

    public function getUsers()
    {
        return $this->curlWrap->curlWrapFunction('/users.json', NULL, "GET");
    }

    public function getUser($userZendeskId)
    {
        if (empty($userZendeskId) || !isset($userZendeskId)) {
            return NULL;
        }
        return $this->curlWrap->curlWrapFunction('/users/' . $userZendeskId . '.json', NULL, "GET");
    }

    public function createTickets($ZendeskTicketsObjects)
    {
        if (empty($ZendeskTicketsObjects) || !isset($ZendeskTicketsObjects) || !is_array($ZendeskTicketsObjects)) {
            return NULL;
        }

        $responses = array();
        foreach ($ZendeskTicketsObjects as $ticket) {
            $objetoStdClass = $this->curlWrap->curlWrapFunction("/tickets.json", json_encode($ticket, JSON_FORCE_OBJECT), "POST");
            if(isset($objetoStdClass->error)) {
                $descriptionError = $objetoStdClass->details->base[0]->description;
                $subject = isset($ticket['subject']) ?  $ticket['subject'] : "NO SUBJECT";
                $responses[] = "Error on the ticket " . $subject . ': ' . $descriptionError;
            }
            else {
                $responses[] = true;
            }
        }

        return $responses;
    }
}
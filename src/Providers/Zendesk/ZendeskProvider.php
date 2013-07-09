<?php
require_once __DIR__ . '/../curlWrap.php';

class ZendeskProvider
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


        $ticketCounter = 1;
        $responses = array();
        foreach ($ZendeskTicketsObjects as $ticket) {
            $objetoStdClass = $this->curlWrap->curlWrapFunction("/tickets.json", json_encode($ticket, JSON_FORCE_OBJECT), "POST");

            $result = new Result();
            if(isset($objetoStdClass->error)) {
                $descriptionError = $objetoStdClass->details->base[0]->description;

                $result->id = 0;
                $result->text = "Error on the ticket number " . $ticketCounter . ": " . $descriptionError;
                $result->ticket = $this->mapTicketToBug($ticket['ticket'], $ticketCounter);
            }
            else {
                $result->id = 1;
                $result->text = "Ticket number " . $ticketCounter . ": OK";
                $result->ticket = $this->mapTicketToBug($ticket['ticket'], $ticketCounter);
            }

            $responses[] = $result;
            $ticketCounter++;
        }

        return $responses;
    }


    private function mapTicketToBug($ticket, $ticketNumber) {
        $bug = new Bug();
        $bug->setId($ticketNumber);
        if(isset($ticket['subject'])) $bug->setSummary($ticket['subject']);
        if(isset($ticket['description'])) $bug->setDescription($ticket['description']);

        $reporter = new Reporter();

        $requesterArray = $ticket['requester'];
        if(isset($requesterArray['name'])) $reporter->setName($requesterArray['name']);
        if(isset($requesterArray['email'])) $reporter->setEmail($requesterArray['email']);
        $bug->setReporter($reporter);

        return $bug;
    }
}
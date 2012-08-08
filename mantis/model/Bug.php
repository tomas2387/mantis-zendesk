<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tomasprado
 * Date: 8/1/12
 * Time: 5:46 PM
 * "id":1,
 * "view_state":{"id":10,"name":"public"},
 * "last_updated":"2012-07-26T11:54:54+02:00",
 * "project":{"id":1,"name":"ProjectTest"},
 * "category":"OsoPanda",
 * "priority":{"id":30,"name":"normal"},
 * "severity":{"id":50,"name":"minor"},
 * "status":{"id":10,"name":"new"},
 * "reporter":{"id":1,"name":"administrator","email":"root@localhost"},
 * "summary":"No puedo caminar",
 * "platform":"Opera","os":"WindowsXP",
 * "os_build":"7",
 * "reproducibility":{"id":10,"name":"always"},
 * "date_submitted":"2012-07-26T11:54:54+02:00",
 * "sponsorship_total":0,
 * "projection":{"id":10,"name":"none"},
 * "eta":{"id":10,"name":"none"},
 * "resolution":{"id":10,"name":"open"},
 * "description":"Me he quedado invalido de repente",
 * "steps_to_reproduce":"1. Romperse las piernas\n2. Intentar caminar \n3. No se puede.\n4. FIN",
 * "additional_information":"Puedo estar asi por un tiempo, pero se me hace dificil ",
 * "attachments":
 * [
 * {
 * "id":1,
 * "filename":"bug1028.png",
 * "size":82547,
 * "content_type":"image\/png",
 * "date_submitted":"2012-07-26T11:54:54+02:00",
 * "download_url":"http:\/\/localhost\/mantis\/mantisbt\/file_download.php?file_id=1&type=bug",
 * "user_id":1
 * }
 * ],
 * "sticky":false,"tags":[]}]
 *
 *
 */

class Bug extends Object {
    private $id;
    private $category;
    private $priority;
    private $severity;
    private $status;
    private $reporter;
    private $summary;
    private $platform;
    private $reproducibility;
    private $date_submitted;
    private $resolution;
    private $description;
    private $steps_to_reproduce;
    private $additional_information;
    private $tags;


    public function setAdditionalInformation($additional_information)
    {
        $this->additional_information = $additional_information;
    }

    public function getAdditionalInformation()
    {
        return $this->additional_information;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDateSubmitted($date_submitted)
    {
        $this->date_submitted = $date_submitted;
    }

    public function getDateSubmitted()
    {
        return $this->date_submitted;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setReporter($reporter)
    {
        $this->reporter = $reporter;
    }

    public function getReporter()
    {
        return $this->reporter;
    }

    public function setReproducibility($reproducibility)
    {
        $this->reproducibility = $reproducibility;
    }

    public function getReproducibility()
    {
        return $this->reproducibility;
    }

    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }

    public function getResolution()
    {
        return $this->resolution;
    }

    public function setSeverity($severity)
    {
        $this->severity = $severity;
    }

    public function getSeverity()
    {
        return $this->severity;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStepsToReproduce($steps_to_reproduce)
    {
        $this->steps_to_reproduce = $steps_to_reproduce;
    }

    public function getStepsToReproduce()
    {
        return $this->steps_to_reproduce;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }
}
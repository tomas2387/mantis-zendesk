<?php
require_once __DIR__ . '/../Item.php';

class Bug extends Item {
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

    function renderView()
    {
        $bugHtml = "";
        if( ! empty($this->id)) {
            $bugHtml .= '<div class="bug">';
            $bugHtml .= '<span class="number">'.$this->id.'</span>';

            if( ! empty($this->summary))
                $bugHtml .= '<span class="summary" title="description">'.$this->summary.'</span>';

            $masDatos = '<div class="masdatos hidden">';

            if( ! empty($this->description)) {
                $masDatos .= '<div><span class="bolded-text">Description:</span>'.$this->description.'</div>';
            }
            else {
                $masDatos .= '<div>No data for description</div>';
            }

            if( ! empty($this->reporter)) {
                $masDatos .= '<div><span class="bolded-text">Reporter:</span>' . $this->reporter->__toString() . '</div>';
            }
            else {
                $masDatos .= '<div>No data for Reporter</div>';
            }

            $masDatos .= '</div>';

            $bugHtml .= $masDatos . '</div>';
        }

        return $bugHtml;
    }
}
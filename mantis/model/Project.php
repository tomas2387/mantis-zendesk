<?php
class Project {

    private $id;
    private $name;
    private $bugs;

    public function __construct() {
        $this->bugs = array();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBugs() {
        return $this->bugs;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setBugs($bugs) {
        if(is_array($bugs)) {
            $this->bugs = $bugs;
        }
    }

}
<?php
/**
 * Created by JetBrains PhpStorm
 * Date: 13/09/12
 * Time: 12:10
 */
class Reporter
{
    private $id;
    private $name;
    private $email;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function __toString(){
        return $this->getName() . " (" . $this->getEmail() . ")";
    }
}

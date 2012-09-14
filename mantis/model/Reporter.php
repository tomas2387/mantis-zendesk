<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 13/09/12
 * Time: 12:10
 * To change this template use File | Settings | File Templates.
 */
class Reporter
{
    private $id;
    private $name;


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

    public function __toString(){
        return $this->getName();
    }
}

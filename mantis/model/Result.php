<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 13/09/12
 * Time: 10:09
 * To change this template use File | Settings | File Templates.
 */
class Result extends Item
{
    public $id;
    public $text;
    public $ticket;

    function __construct() {
        $this->id = -1;
        $this->text = "Error: Result not set";

        $bug = new Bug();
        $bug->setId(0);
        $this->ticket = $bug;
    }

    public function renderView()
    {
        $returnHtml = "";
        if($this->id == -1) {
            $returnHtml = "<div>".$this->text."</div>";
        }
        else {
            $returnHtml = "<div><div>".$this->text."</div><div>". $this->ticket->renderView() ."</div></div>";
        }
        return $returnHtml;
    }
}

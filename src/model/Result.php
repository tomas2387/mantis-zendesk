<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 13/09/12
 * Time: 10:09
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
        if($this->id == -1) {
            $returnHtml = "<div>".$this->text."</div>";
        }
        else {
            $returnHtml = "<div><div>".$this->text."</div><div>". $this->ticket->renderView() ."</div></div>";
        }
        return $returnHtml;
    }
}

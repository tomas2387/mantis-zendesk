<?php
class migrateView extends Item
{
    private $result;

    function __construct($result)
    {
        if ($result === NULL) $result = new Result();

        $this->result = $result;
    }


    public function renderView()
    {
        $html = '<div class="title">Done</div>';
        if ($this->result->id === 1) {
            $html .= '<div>Bugs correctly migrated to Zendesk</div>';
        } else {
            $html .= '<div>There was an error</div><div>' . $this->result->text . '</div>';
        }
        return $html;
    }
}



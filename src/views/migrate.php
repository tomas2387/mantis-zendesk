<?php

require_once __DIR__ . '/../../src/model/Result.php';

class migrateView extends Item
{
    private $ArrayResults;

    function __construct() {
        $this->ArrayResults = array();
    }

    public function addResult($result) {
        if(isset($result))
            $this->ArrayResults[] = $result;
    }

    public function setArrayResults($ArrayResults)
    {
        $this->ArrayResults = $ArrayResults;
    }


    public function renderView()
    {
        $html = "";
        if(empty($this->ArrayResults)) {
            $html = '<div class="title">Fatal Error</div><div>No results on the migration (maybe no issues were migrated?)</div>';
        }
    else {
            $html = '<div class="title">Done</div>';

            foreach($this->ArrayResults as $result)
            {
                if(is_a($result, "Result")) {
                    $html .= "<div>" . $result->renderView() . "</div>";
                }
            }
        }

        return $html;
    }

}



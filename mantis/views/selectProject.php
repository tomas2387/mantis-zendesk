<?php
class selectProjectView extends Item {
    private $arrayMantisProject = array();

    function __construct($arrayMantisProject) {
        $this->arrayMantisProject = $arrayMantisProject;
    }

    public function renderView() {
        if ($this->arrayMantisProject === NULL) $this->arrayMantisProject = array();
        $result = "<script src=\"resources/js/index.js\"></script>

        <div class=\"title\">Select the Mantis Project</div>
        <div>Check the settings.php file to set correctly your mantis endpoint and zendesk API Key</div>
        <div></div>
        <form class=\"form\" action=\"\" method=\"get\">
            <input type=\"hidden\" name=\"bugList\" value=\"\"><select name=\"project\"> ";


        $list = "";
        foreach ($this->arrayMantisProject as $project) {
            $list.= "<option value = \"".$project['id']."\" >".$project['name']."</option>";
        }

        $result.= $list." </select><input type=\"submit\" value = \"Next\"></form><div class=\"errormessage hidden\"></div>";
        return $result;
    }
}





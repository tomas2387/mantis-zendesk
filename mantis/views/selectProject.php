<?php
class selectProjectView extends Item
{
    private $arrayMantisProject = array();

    function __construct($arrayMantisProject)
    {
        $this->arrayMantisProject = $arrayMantisProject;
    }

    public function renderView()
    {
        if ($this->arrayMantisProject === NULL) $this->arrayMantisProject = array();
        $result = "<script src=\"resources/js/index.js\"></script>

        <div class=\"title\">Select the Mantis Project</div>
        <div>Check the settings.php file to set correctly your mantis endpoint and zendesk API Key</div>
        <div></div>
        <form class=\"form\" action=\"\" method=\"get\">
            <input type=\"hidden\" name=\"bugList\" value=\"\"><div><select name=\"project\">";

        $list = "";
        foreach ($this->arrayMantisProject as $project) {
            $list .= "<option value = \"" . $project->getId() . "\" >" . $project->getName() . "</option>";
        }

        $result .= $list . "</select><input type=\"submit\" value = \"Next\"></div><div><input id=\"openissues\" name=\"openissues\" value=\"true\" type=\"checkbox\" checked=\"checked\"><label for=\"openissues\">I want to migrate only new mantis bugs</label></div></form><div class=\"errormessage hidden\"></div>";
        return $result;
    }
}





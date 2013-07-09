<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 12/09/12
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */
class errorView extends Item
{

    private $errorText;

    public function renderView()
    {
        return "<h1>Error</h1>".$this->errorText;
    }

    public function setErrorText($error) {
        $this->errorText = $error;
    }

}

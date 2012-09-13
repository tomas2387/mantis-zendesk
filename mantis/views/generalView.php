<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyeos
 * Date: 10/09/12
 * Time: 9:54
 * To change this template use File | Settings | File Templates.
 */
class generalView
{
    private $items;

    public function __construct()
    {
        $this->items = array();
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function addItem($item)
    {
        if (!$item == NULL) array_push($this->items, $item);
    }

    function render()
    {
        $html = "";
        foreach ($this->items as $item) {
            $html .= $item->renderView();
        }
        return $html;
    }
}

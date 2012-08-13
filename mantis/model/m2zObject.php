<?php
class m2zObject
{
    var $updtFields;//keep track of affected values
    function Object($record="") {
        if (is_array($record))
        {
            $this->updtFields = array();
            foreach(array_keys(get_class_vars(get_class($this))) as $k)
                if (isset($record[$k]))
                {
                    $this->$k = $record[$k];
                    $this->updtFields[] = $k;
                }
        }
    }//end of arrayToObject

    function toDebug($nl='<br>')
    {
        foreach(array_keys(get_class_vars(get_class($this))) as $k)
            echo "$k = [" . $this->$k . "]{$nl}";
    }//end of toDebug
}
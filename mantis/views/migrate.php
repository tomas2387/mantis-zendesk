<?php
class migrateView
{
    public function renderView($result)
    {
        $html = '<div class="title">Done</div>';
        if($result->id === 1)
        {
            $html .= '<div>Bugs correctly migrated to Zendesk</div>';
        } else {
            $html .= '<div>There was an error</div><div>'.$result->text.'</div>';
        }
        return $html;
    }
}
?>


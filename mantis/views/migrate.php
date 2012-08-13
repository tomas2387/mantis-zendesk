
<div class="title">Done</div>
<?php if($result->id === 1) { ?>
    <div>Bugs correctly migrated to Zendesk</div>
<?php } else { ?>
    <div>There was an error</div>
    <div><?php echo $result->text; ?></div>
<?php } ?>


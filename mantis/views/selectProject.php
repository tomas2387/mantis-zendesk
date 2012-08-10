<script src="resources/js/index.js"></script>

<div class="title">Select the Mantis Project</div>
<div>Check the settings.php file to set correctly your mantis endpoint and zendesk API Key</div>
<form class="form" action="" method="get">
    <input type="hidden" name="bugList" value="">
    <select name="project">
        <?php foreach ($arrayMantisProjects as $project): ?>
        <option value="<?php echo $project['id']; ?>">
            <?php echo $project['name']; ?>
        </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Next">
</form>
<div class="errormessage hidden"></div>
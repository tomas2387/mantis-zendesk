
<script src="resources/js/index.js"></script>
<form action="index.php?migrate=" method="POST">
    <div class="block">
        <div class="title2"><span>Users Mapping</span></div>
        <div>
            <?php foreach($arrayMantisReporters as $MantisUser): ?>
            <div>
                    <span>
                        The mantis user <span style="color: gray; font-weight: bold">"<?php echo $MantisUser; ?>"</span> in Zendesk is going to be <img src="resources/images/icons/arrow_right.png" style="position: relative; top: 3px;">
                    </span>
                <select name="reporter">
                    <option value=<?php echo '"'.$MantisUser.'"'; ?> >
                        <?php echo implode('</option><option>', $arrayZendeskReporters); ?>
                    </option>
                </select>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="block">
        <div class="title2"><span>Bug List</span></div>
        <?php foreach($arrayMantisBugs as $bug): ?>
        <div class="bug">
            <span class="number"><?php echo $bug['id']; ?></span>
            <span class="summary" title="'+value.description+'"><?php echo $bug['summary']; ?></span>
            <div class="masdatos hidden">
                <div><span class="bolded-text">Description:</span><?php echo $bug['description']; ?></div>
                <div><span class="bolded-text">Reporter:</span><?php echo $bug['reporter']['name']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" id="migrate">Move all to Zendesk</button>
</form>

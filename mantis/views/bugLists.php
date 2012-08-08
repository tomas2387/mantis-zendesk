
            <script src="../../resources/js/index.js"></script>
            <div id="settings">
                <span>Settings: Users mapping</span>
                <div>
                    <form>
                        <?php foreach($arrayMantisReporters as $MantisUser): ?>
                        <div>
                            <label>
                                <?php echo $MantisUser; ?>
                            </label>
                            <select>
                                <option>
                                    <?php echo implode('</option><option>', $arrayZendeskReporters); ?>
                                </option>
                            </select>
                        </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
            <div class="title">Bug list</div>
            <div class="buglist">
                <?php foreach($arrayMantisBugs as $bug): ?>
                    <div class="bug">
                        <span class="number"><?php echo $bug.id; ?></span>
                        <span class="summary" title="'+value.description+'"><?php echo $bug.summary; ?></span>
                        <div class="masdatos hidden">
                            <div><span class="bolded-text">Description:</span><?php echo $bug.description; ?></div>
                            <div><span class="bolded-text">Reporter:</span><?php echo $bug.reporter.name; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button id="migrate">Move all to Zendesk</button>

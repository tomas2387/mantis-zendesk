<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="centered-container">
        <div class="container">
            <title>Mantis bug migration</title>
            <header>
                <div class="logo"></div>
                <div class="logo-title">
                    <span>Mantis</span><span class="two-logo">2</span><span class="zendesk-logo-text">Zendesk</span>
                </div>
            </header>



            <div id="content">

                <div id="settings">
                <span>Settings: Users mapping</span>
                    <div>

                    </div>
                </div>
                <div class="title">Type the Mantis project name</div>
                <div>Check the settings.php file to set your mantis endpoint</div>
                <form class="form" action="#">
                    <input id="projectName" type="text" name="projectName" placeholder="Project Name">
                    <input type="submit">
                </form>
                <div class="errormessage hidden"></div>
            </div>

        </div>
        <footer class="version">
            <div class="famfam">
                <a href="http://www.famfamfam.com/lab/icons/silk/">Icons by Mark James</a>
            </div>
        </footer>
    </div>
</body>
</html>
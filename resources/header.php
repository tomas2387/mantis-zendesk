<?php

class Header {

    function renderView() {
        $result = '<!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset="utf-8">
                        <link rel="stylesheet" type="text/css" href="resources/css/style.css"/>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
                            <div id="content">';


        return $result;
    }

}
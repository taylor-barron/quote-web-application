<?php // Script 13.3 - <header class="html">

// Include the functions script:
include('includes/function.php'); ?>
</header>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" media="all" href="css/style.css">-->
    <title><?php // Print the page title
        if (defined('TITLE')) {  // Is the title defined?
            print TITLE;
        } else {  // The title is not defined.
            print 'My Site of Quotes';
        } ?>
    </title>
</head>
<body>
    <div id="container">
        <h1>My Site of Quotes</h1>
        <br>
        <!-- BEGIN CHANGEABLE CONTENT -->
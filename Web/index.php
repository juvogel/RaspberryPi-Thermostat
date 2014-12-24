<!doctype html>
<html>

<head>
    <title>Thermostat Adjuster</title>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta charset="utf-8">
    <meta name="application-name" content="RPi Thermostat" />
    <meta name="author" content="Bobby Vogel">
    <meta name="twitter:site" content="@bvog92">
    <meta property="og:url" content="http://pi.bobbyvogel.com">
    <meta name="viewport" content="user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-title" content="RPi Thermostat">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
    <link rel="stylesheet" type="text/css" href="desktop.css" media="only screen and (min-width:720px)">
    <link rel="stylesheet" type="text/css" href="mobile.css" media="only screen and (max-width:719px) and (min-width:320px)">
    <?php include 'simple_html_dom.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="thermostat.js"></script>
</head>

<body>
    <div id="temp">
        <div id="ctemp"></div>
        <div id="change">
            <div id="arrow-up"></div>
            <div id="dtemp"></div>
            <div id="arrow-down"></div>
        </div>
    </div>
    <div id="mode">
        <button id="heat">Heat</button>
        <button id="off">Off</button>
        <button id="cool">Cool</button>
    </div>
</body>

</html>
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
    
    <!-- Apple Web App tags start here -->
    <meta name="apple-mobile-web-app-title" content="RPi Thermostat">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- iPad, iOS 7, retina -->
    <link href="img/apple-touch-icon-152x152.png"
          sizes="152x152"
          rel="apple-touch-icon">
    <!-- iPad, iOS 6, retina -->
    <link href="img/apple-touch-icon-144x144.png"
          sizes="144x144"
          rel="apple-touch-icon">
    <!-- iPhone, iOS 7, retina -->
    <link href="img/apple-touch-icon-120x120.png"
          sizes="120x120"
          rel="apple-touch-icon">
    <!-- iPhone ,iOS 6, retina -->
    <link href="img/apple-touch-icon-114x114.png"
          sizes="114x114"
          rel="apple-touch-icon">
    <!-- iPad, iOS 7 -->
    <link href="img/apple-touch-icon-76x76.png"
          sizes="76x76"
          rel="apple-touch-icon">
    <!-- iPad, iOS 6 -->
    <link href="img/apple-touch-icon-72x72.png"
          sizes="72x72"
          rel="apple-touch-icon">
    <!-- iPhone, iOS 7 -->
    <link href="img/apple-touch-icon-60x60.png"
          sizes="60x60"
          rel="apple-touch-icon">
    <!-- iPhone, iOS 6 -->
    <link href="img/apple-touch-icon-57x57.png"
          sizes="57x57"
          rel="apple-touch-icon">
    <!-- iPad, retina, portrait -->
    <link href="img/apple-touch-startup-image-1536x2008.png"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">
    <!-- iPad, retina, landscape -->
    <link href="img/apple-touch-startup-image-1496x2048.png"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">
    <!-- iPad, portrait -->
    <link href="img/apple-touch-startup-image-768x1004.png"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">
    <!-- iPad, landscape -->
    <link href="img/apple-touch-startup-image-748x1024.png"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">
    <!-- iPhone 5 -->
    <link href="img/apple-touch-startup-image-640x1096.png"
          media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">
    <!-- iPhone, retina -->
    <link href="img/apple-touch-startup-image-640x920.png"
          media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">
    <!-- iPhone -->
    <link href="img/apple-touch-startup-image-320x460.png"
          media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">
    <!-- Apple Web App tags end here -->      
    
    <link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="desktop.css" media="only screen and (min-width:720px)">
    <link rel="stylesheet" type="text/css" href="mobile.css" media="only screen and (max-width:719px) and (min-width:320px)">
    <?php include 'simple_html_dom.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="thermostat.js"></script>
</head>

<body>
    <nav>RPi Thermostat</nav>
    <div id="home">
        <div id="temp">
            <div id="ctemp"></div>
            <div id="change">
                <div id="arrow-up"></div>
                <div id="dtemp"></div>
                <div id="arrow-down"></div>
            </div>
        </div>
        <div>
            <svg version="1.1" id="heat" class="mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="49.708px" height="84.462px" style="fill:#afafaf;" viewBox="-3.624 -5.935 49.708 84.462" enable-background="new -3.624 -5.935 49.708 84.462"
            xml:space="preserve">
            <path id="Flame" d="M9.34-5.935c0,0,13.216,9.333,0,28.51C-2.599,39.904-9.727,58.303,3.456,72.043
            c3.816,3.98,8.345,6.008,12.974,6.484c-7.48-2.178-13.056-9.641-6.561-22.994c3.997-8.205,13.947-17.875,10.634-29.266
            c0,0,8.958,11.283,2.858,28.48c-2.77,7.814,9.439,8.668,6.133,0.139c-2.002-5.15,9.443,10.24,3.277,19.131
            C38.589,70,41.736,63.385,44.044,56.322C50.595,36.297,41.974,3.995,9.34-5.935z"/>
            </svg>
            <svg version="1.1" id="cool" class="mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="75.072px" height="84.462px" style="fill:#afafaf;" viewBox="218.899 214.861 75.072 84.462"
            enable-background="new 218.899 214.861 75.072 84.462" xml:space="preserve">
            <g id="Artwork">
            </g>
            <g id="Snowflake">
            <path d="M290.387,268.421c-1.087-0.629-2.326-0.961-3.579-0.961c-1.927,0-3.761,0.785-5.091,2.121l-6.771-3.908l7.809-2.098
            c0.971-0.264,1.553-1.258,1.289-2.234c-0.262-0.975-1.263-1.551-2.232-1.295l-11.338,3.041l-2.214-1.279l-3.464-4.725l3.421-4.683
            l2.257-1.302l11.338,3.037c0.158,0.043,0.311,0.064,0.471,0.064c0.809,0,1.546-0.539,1.762-1.354
            c0.264-0.976-0.318-1.977-1.289-2.237l-7.809-2.092l6.771-3.912c1.33,1.338,3.164,2.121,5.091,2.121
            c1.253,0,2.492-0.332,3.579-0.959c1.656-0.957,2.841-2.503,3.34-4.352c0.493-1.849,0.239-3.779-0.719-5.436
            c-1.273-2.213-3.658-3.586-6.209-3.586c-1.249,0-2.487,0.332-3.578,0.961c-1.658,0.957-2.846,2.502-3.337,4.351
            c-0.335,1.245-0.323,2.526,0.005,3.737l-6.771,3.91l2.092-7.809c0.262-0.973-0.313-1.975-1.291-2.237
            c-0.975-0.261-1.977,0.317-2.238,1.292l-3.037,11.337l-2.209,1.276l-5.824,0.637l-2.349-5.315v-2.591l8.302-8.3
            c0.714-0.715,0.714-1.87,0-2.584c-0.714-0.712-1.869-0.712-2.583,0l-5.719,5.717v-7.82c3.071-0.811,5.338-3.609,5.338-6.929
            c0-3.951-3.21-7.165-7.163-7.165s-7.166,3.214-7.166,7.165c0,3.319,2.271,6.118,5.341,6.929v7.82l-5.718-5.715
            c-0.714-0.714-1.87-0.714-2.584,0c-0.711,0.712-0.711,1.871,0,2.583l8.302,8.3v2.557l-2.358,5.355l-5.783-0.625l-2.24-1.294
            l-3.039-11.339c-0.262-0.973-1.262-1.553-2.237-1.29c-0.973,0.261-1.552,1.263-1.292,2.237l2.094,7.808l-6.771-3.909
            c0.332-1.211,0.34-2.492,0.006-3.738c-0.496-1.848-1.68-3.393-3.34-4.35c-1.088-0.629-2.324-0.961-3.576-0.961
            c-2.555,0-4.936,1.373-6.211,3.584c-0.955,1.658-1.211,3.588-0.715,5.438c0.494,1.848,1.681,3.393,3.34,4.35
            c1.086,0.629,2.324,0.961,3.574,0.961c1.932,0,3.761-0.785,5.092-2.121l6.775,3.912l-7.809,2.092
            c-0.977,0.261-1.553,1.262-1.292,2.237c0.22,0.815,0.956,1.354,1.763,1.354c0.156,0,0.315-0.021,0.475-0.064l11.338-3.037
            l2.221,1.283l3.455,4.715l-3.432,4.691l-2.244,1.299l-11.338-3.041c-0.977-0.256-1.978,0.32-2.237,1.295
            c-0.261,0.971,0.315,1.971,1.29,2.234l7.811,2.098l-6.775,3.908c-1.331-1.336-3.16-2.121-5.092-2.121
            c-1.25,0-2.488,0.332-3.574,0.961c-1.659,0.953-2.846,2.5-3.34,4.35c-0.496,1.852-0.24,3.781,0.715,5.436
            c1.275,2.213,3.656,3.586,6.211,3.586c1.252,0,2.488-0.336,3.576-0.961c1.657-0.955,2.844-2.502,3.34-4.352
            c0.334-1.242,0.326-2.527-0.006-3.738l6.771-3.91l-2.094,7.812c-0.26,0.973,0.319,1.975,1.292,2.234
            c0.159,0.041,0.318,0.062,0.476,0.062c0.807,0,1.544-0.539,1.762-1.352l3.039-11.336l2.225-1.285l5.81-0.637l2.348,5.311v2.6
            l-8.302,8.303c-0.711,0.713-0.711,1.869,0,2.582c0.357,0.355,0.824,0.535,1.291,0.535c0.469,0,0.936-0.18,1.293-0.535l5.718-5.717
            v7.818c-3.07,0.812-5.341,3.611-5.341,6.932c0,3.949,3.213,7.164,7.166,7.164s7.163-3.215,7.163-7.164
            c0-3.32-2.267-6.119-5.338-6.932v-7.818l5.719,5.717c0.714,0.715,1.869,0.715,2.583,0c0.714-0.713,0.714-1.869,0-2.582
            l-8.302-8.303v-2.559l2.357-5.357l5.77,0.621l2.255,1.307l3.043,11.336c0.215,0.812,0.953,1.352,1.76,1.352
            c0.154,0,0.314-0.021,0.473-0.062c0.978-0.26,1.553-1.262,1.291-2.24l-2.092-7.807l6.771,3.91c-0.328,1.211-0.34,2.496-0.005,3.738
            c0.491,1.85,1.679,3.396,3.337,4.352c1.091,0.625,2.329,0.961,3.578,0.961c2.551,0,4.936-1.373,6.209-3.586
            c0.958-1.654,1.212-3.584,0.719-5.436C293.228,270.921,292.043,269.374,290.387,268.421z M283.412,238.651
            c0.24-0.906,0.822-1.664,1.633-2.133c0.541-0.309,1.141-0.473,1.754-0.473c1.252,0,2.424,0.674,3.045,1.758
            c0.472,0.812,0.596,1.76,0.354,2.664c-0.247,0.906-0.827,1.664-1.64,2.133c-0.533,0.309-1.14,0.473-1.751,0.473
            c-1.253,0-2.419-0.674-3.048-1.758C283.293,240.503,283.171,239.556,283.412,238.651z M229.109,241.315
            c-0.626,1.084-1.795,1.758-3.049,1.758c-0.61,0-1.215-0.164-1.748-0.473c-0.814-0.468-1.395-1.227-1.637-2.133
            c-0.244-0.904-0.117-1.852,0.35-2.664c0.627-1.084,1.792-1.758,3.047-1.758c0.61,0,1.217,0.164,1.751,0.473
            c0.812,0.468,1.394,1.227,1.636,2.133C229.703,239.556,229.576,240.503,229.109,241.315z M229.459,275.534
            c-0.242,0.906-0.824,1.664-1.636,2.133c-0.534,0.309-1.141,0.471-1.751,0.471c-1.255,0-2.42-0.672-3.047-1.756
            c-0.467-0.812-0.594-1.756-0.35-2.666c0.242-0.904,0.822-1.664,1.637-2.133c0.533-0.307,1.138-0.473,1.748-0.473
            c1.254,0,2.423,0.674,3.049,1.758C229.576,273.679,229.703,274.63,229.459,275.534z M252.922,222.026
            c0-1.937,1.577-3.511,3.514-3.511c1.938,0,3.51,1.574,3.51,3.511s-1.572,3.512-3.51,3.512
            C254.499,225.539,252.922,223.963,252.922,222.026z M259.945,292.159c0,1.936-1.572,3.512-3.51,3.512
            c-1.937,0-3.514-1.576-3.514-3.512c0-1.938,1.577-3.51,3.514-3.51C258.373,288.649,259.945,290.222,259.945,292.159z
             M259.684,260.55c-0.795-0.086-1.55,0.35-1.869,1.078l-1.373,3.125l-1.379-3.125c-0.293-0.66-0.954-1.082-1.67-1.082
            c-0.066,0-0.133,0-0.201,0.01l-3.387,0.371l2.012-2.756c0.469-0.643,0.469-1.517,0-2.155l-2.018-2.751l3.391,0.365
            c0.791,0.087,1.547-0.352,1.867-1.08l1.375-3.121l1.379,3.119c0.316,0.729,1.078,1.166,1.869,1.078l3.39-0.371l-2.013,2.752
            c-0.475,0.643-0.47,1.516,0,2.16l2.018,2.748L259.684,260.55z M289.844,276.382c-0.628,1.084-1.793,1.756-3.045,1.756
            c-0.613,0-1.221-0.162-1.754-0.471c-0.811-0.469-1.393-1.227-1.633-2.133c-0.241-0.904-0.119-1.855,0.348-2.666
            c0.629-1.084,1.795-1.758,3.048-1.758c0.611,0,1.218,0.166,1.751,0.473c0.812,0.469,1.393,1.229,1.64,2.133
            C290.439,274.626,290.315,275.569,289.844,276.382z"/>
            </g>
            </svg>
            <svg version="1.1" id="off" class="mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="60.901px" height="84.869px" style="fill:#afafaf;" viewBox="2.711 -24.861 60.901 84.869" enable-background="new 2.711 -24.861 60.901 84.869"
            xml:space="preserve">
            <g id="Leaf">
            <path d="M11.861,47.318c0,0-5.81,10.149-4.159,12.689l-4.991-3.165c0,0,3.802-9.747,6.637-14.769
            C11.022,46.227,11.861,47.318,11.861,47.318z"/>
            <g>
            <path d="M57.568-24.861C55.115-11.841,45.044,0.742,33.113,5.296c-8.587,3.279-43.095,7.655-21.276,42.035
            c0,0,0.182-2.98,0.292-3.971c1.231-10.994,8.203-20.351,31.154-27.46c0,0-23.94,11.856-28.188,32.444
            c9.607-0.457,31.557,5.384,42.863-18.353C67.537,13.735,63.239-7.17,57.568-24.861z"/>
            </g>
            </g>
            </svg>
        </div>
        <br/><span id="heatState"></span>
        <span id="coolState"></span>
        <span id="offState"></span>
    </div>
    <div id="schedule">
        
    </div>
</body>

</html>
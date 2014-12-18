<!doctype html>
<html>
    <head>
        <title>Thermostat Adjuster</title>
        <meta charset="utf-8">
        <meta name="application-name" content="Thermostat Adjuster"/>
        <meta name="author" content="Bobby Vogel">
        <meta name="twitter:site" content="@bvog92">
        <meta property="og:url" content="http://pi.bobbyvogel.com" />
        <?php
            include 'simple_html_dom.php';
        ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $( document ).ready( function() {
                // fetches dtemp value from file
                $.get( "thermo/dtemp", function( data ) {
                  $( "#dtemp" ).html( data );
                  $( "#dtemp" ).html( parseInt( data ));
                });

                // fetches ctemp value from file
                var currentTemp = $.get( "thermo/ctemp", function( data ) {
                  $( "#ctemp" ).html( data );
                  $( "#ctemp" ).html( parseInt( data ));
                });

                $.get( "thermo/mode", function( mode ) {
                  if (mode == "2") {
                      document.getElementById( "heat" ).style.color = '#0e83cd';
                      document.getElementById( "heat" ).style.background = '#fff';
                      document.getElementById( "heat" ).style.borderColor = '#0e83cd';
                  } else if (mode == "1") {
                      document.getElementById( "cool" ).style.color = '#0e83cd';
                      document.getElementById( "cool" ).style.background = '#fff';
                      document.getElementById( "cool" ).style.borderColor = '#0e83cd';
                  } else if (mode == "0") {
                      document.getElementById( "off" ).style.color = '#0e83cd';
                      document.getElementById( "off" ).style.background = '#fff';
                      document.getElementById( "off" ).style.borderColor = '#0e83cd';
                  }
                });

                //increment dtemp when up arrow is pressed
                $( "#arrow-up" ).click( function() {
                    var temp = $( "#dtemp" ).text();
                    temp = parseInt( temp ) + 1;
                    $( "#dtemp" ).html( temp );
                    $.post('dtempupdate.php', {"data": temp});
                });

                //decrement dtemp when down arrow is pressed
                $( "#arrow-down" ).click( function() {
                    var temp = $( "#dtemp" ).text();
                    temp = parseInt( temp ) - 1;
                    $( "#dtemp" ).html( temp );
                    $.post('dtempupdate.php', {"data": temp});
                });

                $( "#heat" ).click( function() {
                    var mode = 2;
                    document.getElementById( "heat" ).style.color = '#0e83cd';
                    document.getElementById( "heat" ).style.background = '#fff';
                    document.getElementById( "heat" ).style.borderColor = '#0e83cd';
                    document.getElementById( "cool" ).style.color = '#fff';
                    document.getElementById( "cool" ).style.background = '#0e83cd';
                    document.getElementById( "cool" ).style.borderColor = '#fff';
                    document.getElementById( "off" ).style.color = '#fff';
                    document.getElementById( "off" ).style.background = '#0e83cd';
                    document.getElementById( "off" ).style.borderColor = '#fff';
                    $.post('modeupdate.php', {"data": mode});
                });
                $( "#cool" ).click( function() {
                    var mode = 1;
                    document.getElementById( "cool" ).style.color = '#0e83cd';
                    document.getElementById( "cool" ).style.background = '#fff';
                    document.getElementById( "cool" ).style.borderColor = '#0e83cd';
                    document.getElementById( "heat" ).style.color = '#fff';
                    document.getElementById( "heat" ).style.background = '#0e83cd';
                    document.getElementById( "heat" ).style.borderColor = '#fff';
                    document.getElementById( "off" ).style.color = '#fff';
                    document.getElementById( "off" ).style.background = '#0e83cd';
                    document.getElementById( "off" ).style.borderColor = '#fff';
                    $.post('modeupdate.php', {"data": mode});
                });
                $( "#off" ).click( function() {
                    var mode = 0;
                    document.getElementById( "off" ).style.color = '#0e83cd';
                    document.getElementById( "off" ).style.background = '#fff';
                    document.getElementById( "off" ).style.borderColor = '#0e83cd';
                    document.getElementById( "cool" ).style.color = '#fff';
                    document.getElementById( "cool" ).style.background = '#0e83cd';
                    document.getElementById( "cool" ).style.borderColor = '#fff';
                    document.getElementById( "heat" ).style.color = '#fff';
                    document.getElementById( "heat" ).style.background = '#0e83cd';
                    document.getElementById( "heat" ).style.borderColor = '#fff';
                    $.post('modeupdate.php', {"data": mode});
                });

                $( document ).keydown(function(e) {
                    var code = e.which;
                    if (code == 38) { // increment dtemp when up arrow is pressed
                        var temp = $( "#dtemp" ).text();
                        temp = parseInt( temp ) + 1;
                        $( "#dtemp" ).html( temp );
                        $.post('dtempupdate.php', {"data": temp});
                    } else if (code == 40) { // decrement dtemp when down arrow is pressed
                        var temp = $( "#dtemp" ).text();
                        temp = parseInt( temp ) - 1;
                        $( "#dtemp" ).html( temp );
                        $.post('dtempupdate.php', {"data": temp});
                    }
                });

                // change mode

                //TODO: reload ctemp every 15 secs
            });
        </script>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div id="temp">
            <div id="ctemp"></div>
            <div id="change">
                <div id="arrow-up" onclick="increment()"></div>
                <div id="dtemp"></div>
                <div id="arrow-down" onclick="decrement()"></div>
            </div>
        </div>
        <div id="mode">
            <button id="heat">Heat</button>
            <button id="off">Off</button>
            <button id="cool">Cool</button>
        </div>
    </body>
</html>

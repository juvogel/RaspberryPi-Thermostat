/*
    Google Material Design Color Palette
    http://www.google.com/design/spec/style/color.html#color-color-palette
*/
$(document).ready(function () {

    function heatState(mode) {
        var timer;
        if (mode === true) {
            document.getElementById("heat").style.fill = '#FF3D00'; // Deep Orange A400
            // add 'on' to heatState span
            document.getElementById("heatState").innerHTML = "HEAT ON";
            // fade in and out 'heat on' message
            $("#heatState").stop(true, true).fadeIn('fast');
            timer = setTimeout(function (){
                $("#heatState").stop(true, true).fadeOut('fast');
            }, 2*1000);
        } else {
            clearTimeout(timer);
            document.getElementById("heat").style.fill = '#AFAFAF';
            // add 'off' to heatState span
            document.getElementById("heatState").innerHTML = "";
        }
    }
    /*function fanState(mode) {
        if (mode === true) {
            document.getElementById("fan").style.fill = '#fff';
        } else {
            document.getElementById("fan").style.fill = '#afafaf';
        }
    }*/
    function coolState(mode) {
        var timer;
        if (mode === true) {
            document.getElementById("cool").style.fill = '#448AFF'; // Blue A200
            // add 'on' to coolState span
            document.getElementById("coolState").innerHTML = "A/C ON";
            // fade in and out 'cool on' message
            $("#coolState").stop(true, true).fadeIn('fast');
            timer = setTimeout(function (){
                $("#coolState").stop(true, true).fadeOut('fast');
            }, 2*1000);
        } else {
            clearTimeout(timer);
            document.getElementById("cool").style.fill = '#AFAFAF';
            // add 'off' to coolState span
            document.getElementById("coolState").innerHTML = "";
        }
    }

    // increase dtemp
    function increase() {
        var temp = $("#dtemp").text();
        temp = parseInt(temp, 10) + 1;
        $("#dtemp").html(temp);
        $.post('dtempupdate.php', {
            "data": temp
        });
    }

    // decrease dtemp
    function decrease() {
        var temp = $("#dtemp").text();
        temp = parseInt(temp, 10) - 1;
        $("#dtemp").html(temp);
        $.post('dtempupdate.php', {
            "data": temp
        });
    }

    function setModeHeat() {
        var mode = 2;
        heatState(true);
        coolState(false);
        $.post('modeupdate.php', {
            "data": mode
        });
    }

    function setModeCool() {
        var mode = 1;
        coolState(true);
        heatState(false);
        $.post('modeupdate.php', {
            "data": mode
        });
    }

    /*function setModeOff() {
        var mode = 0;
        buttonSetStyle("off");
        buttonResetStyle("cool");
        buttonResetStyle("heat");
        $.post('modeupdate.php', {
            "data": mode
        });
    }*/

    // fetches dtemp value from file
    $.get("thermo/dtemp", function (data) {
        $("#dtemp").html(parseInt(data, 10));
    });

    // fetches ctemp value from file
    var currentTemp = $.get("thermo/ctemp", function (data) {
        $("#ctemp").html(parseInt(data, 10));
    });

    $.get("thermo/mode", function (mode) {
        if (mode === "2") {
            heatState(true);
        } else if (mode === "1") {
            coolState(true);
        } else if (mode === "0") {
            // nothing goes here
        }
    });

    //increment dtemp when up arrow is pressed
    $("#arrow-up").on("mousedown touchstart", function (e) {
        if (e.type === "mousedown") {
            increase();
            e.preventDefault();
        } else {
            increase();
            e.preventDefault();
        }
    });

    //decrement dtemp when down arrow is pressed
    $("#arrow-down").on("mousedown touchstart", function (e) {
        if (e.type === "mousedown") {
            decrease();
            e.preventDefault();
        } else {
            decrease();
            e.preventDefault();
        }
    });

    $("#heat").on("click touchstart", function (e) {
        if (e.type === "click") {
            setModeHeat();
            e.preventDefault();
        } else {
            setModeHeat();
            e.preventDefault();
        }
    });

    $("#cool").on("click touchstart", function (e) {
        if (e.type === "click") {
            setModeCool();
            e.preventDefault();
        } else {
            setModeCool();
            e.preventDefault();
        }
    });

    /*$("#off").on("click touchstart", function (e) {
        if (e.type === "click") {
            setModeOff();
            e.preventDefault();
        } else {
            setModeOff();
            e.preventDefault();
        }
    });*/

    $(document).keydown(function (e) {
        var code = e.which;
        if (code === 38) { // increment dtemp when up arrow is pressed
            increase();
        } else if (code === 40) { // decrement dtemp when down arrow is pressed
            decrease();
        } else if (code === 49) { // '1' is pressed turn on heat
            setModeHeat();
        } else if (code === 50) { // '3' is pressed turn on ac
            setModeCool();
        } else if (code === 79) { // 'o' is pressed turn off air
            //setModeOff();
        } else if (code === 72) { // 'h' is pressed turn on heat
            setModeHeat();
        } else if (code === 67) { // 'c' is pressed turn on ac
            setModeCool();
        }
    });
});
$(document).ready(function () {

    function buttonResetStyle(mode) {
        document.getElementById(mode).style.color = '#fff';
        document.getElementById(mode).style.background = '#2196F3';
        document.getElementById(mode).style.borderColor = '#2196F3';
    }

    function buttonSetStyle(mode) {
        document.getElementById(mode).style.color = '#2196F3';
        document.getElementById(mode).style.background = '#fff';
        document.getElementById(mode).style.borderColor = '#2196F3';
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
        buttonSetStyle("heat");
        buttonResetStyle("cool");
        buttonResetStyle("off");
        $.post('modeupdate.php', {
            "data": mode
        });
    }

    function setModeCool() {
        var mode = 1;
        buttonSetStyle("cool");
        buttonResetStyle("heat");
        buttonResetStyle("off");
        $.post('modeupdate.php', {
            "data": mode
        });
    }

    function setModeOff() {
        var mode = 0;
        buttonSetStyle("off");
        buttonResetStyle("cool");
        buttonResetStyle("heat");
        $.post('modeupdate.php', {
            "data": mode
        });
    }

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
            buttonSetStyle("heat");
        } else if (mode === "1") {
            buttonSetStyle("cool");
        } else if (mode === "0") {
            buttonSetStyle("off");
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

    $("#off").on("click touchstart", function (e) {
        if (e.type === "click") {
            setModeOff();
            e.preventDefault();
        } else {
            setModeOff();
            e.preventDefault();
        }
    });

    $(document).keydown(function (e) {
        var code = e.which;
        if (code === 38) { // increment dtemp when up arrow is pressed
            increase();
        } else if (code === 40) { // decrement dtemp when down arrow is pressed
            decrease();
        } else if (code === 49) { // '1' is pressed turn on heat
            setModeHeat();
        } else if (code === 50) { // '2' is pressed turn off air
            setModeOff();
        } else if (code === 51) { // '3' is pressed turn on ac
            setModeCool();
        } else if (code === 79) { // 'o' is pressed turn off air
            setModeOff();
        } else if (code === 72) { // 'h' is pressed turn on heat
            setModeHeat();
        } else if (code === 67) { // 'c' is pressed turn on ac
            setModeCool();
        }
    });
});
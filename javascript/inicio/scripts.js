$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length;
    var panel_count=$('div[name=panel]').length;
    // cambiar css
    var pasa = true;
    $(document).keydown(function (event) {
        console.log(event);
        if (event.shiftKey && (event.key == "z" && event.altKey || event.key == "Z" && event.altKey)) {
            if (pasa) {
                $('body').css("background", "#efefef").css("color", "#000");
                $('#query').css("background", "#efefef").css("color", "#000");
                $('h1,h2,h3,h4').css("background", "#efefef").css("color", "#000");
                $('button').css("background", "#efefef").css("color", "#000");
                $('div').css("background", "#efefef").css("color", "#000");
                pasa = false;
            } else {
                $('body').css("background", "#000").css("color", "#fff");
                $('#query').css("background", "#000").css("color", "#fff");
                $('h1,h2,h3,h4').css("background", "#000").css("color", "#fff");
                $('div').css("background", "#000").css("color", "#fff");
                pasa = true;
            }
        }
    }); 
    
    ////////////////// scripts para el ajuste de letras
    $("#small").click(function (event) {
        event.preventDefault();
        $("h1").animate({"font-size": "34px"});
        $("h2").animate({"font-size": "26px"});
        $("p").animate({"font-size": "22px", "line-height": "26px"});

    });

    $("#medium").click(function (event) {
        event.preventDefault();
        $("h1").animate({"font-size": "46px"});
        $("h2").animate({"font-size": "34px"});
        $("p").animate({"font-size": "24px", "line-height": "30px"});

    });

    $("#large").click(function (event) {
        event.preventDefault();
        $("h1").animate({"font-size": "78px"});
        $("h2").animate({"font-size": "50px"});
        $("p").animate({"font-size": "36px", "line-height": "40px"});

    });

    $("a").click(function () {
        $("a").removeClass("selected");
        $(this).addClass("selected");

    });
    //////////////////
    $('div[name=Adesc]').hide();
    $("#panel1").focus();
    var seccion_actual = 0;
    var panel_actual = 0;
    
    $(document).keydown(function (e) {
        var evtobj = window.event ? event : e;
        //console.log(evtobj.keyCode);
        if (evtobj.keyCode === 90 && evtobj.ctrlKey) {
            if (seccion_actual === 0) {
                seccion_actual++;
            } else if (seccion_actual > count_element) {
                seccion_actual = 1;
            }
            if ($("#seccion" + seccion_actual).is(":visible") === true) {
                $("#seccion" + seccion_actual).focus();
                console.log("seccion " + seccion_actual);
                seccion_actual++;
            } else {
                while ($("#seccion" + seccion_actual).is(":visible") !== true) {
                    seccion_actual++;
                    if (seccion_actual > count_element) {
                        seccion_actual = 1;
                    }
                }
                console.log("seccion=" + seccion_actual);
                $("#seccion" + seccion_actual).focus();
                seccion_actual++;
            }
        } else
        if (evtobj.keyCode === 16 && evtobj.ctrlKey) {
            if (panel_actual === 0) {
                panel_actual++;
            } else if (panel_actual > panel_count) {
                panel_actual = 1;
            }
            console.log("panel " + panel_actual);
            $("#panel" + panel_actual).focus();
            panel_actual++;
        }
    });

    ////////////////////////////////////////////////////////
    $('div[name=panel]').focus(function () {
        $('div[name=seccion]').each(function () {
            $(this).css('background-color', 'darkblue');
            seccion_actual = 0;
        });
    });
    $('div[name=seccion]').focus(function () {
        $('div[name=seccion]').each(function () {
            if ($(this).is(":focus")) {
                //alert($(this).text());
                $(this).css('background-color', '#00650C');
            } else {
                $(this).css('background-color', 'darkblue');
            }
        });
    });
     
});
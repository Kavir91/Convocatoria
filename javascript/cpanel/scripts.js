$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length;
    var panel_count=$('div[name=panel]').length;
    //////////////////

    //////////////////
    $('div[name=Adesc]').hide();
    //$("#instrucciones").focus();
    
    if (typeof $("#panel3") != 'undefined') {
        $("#panel3").focus();
    } else {
        $("#instrucciones").focus();
    }
    
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
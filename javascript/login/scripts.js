$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length
    $('div[name=Adesc]').hide();
    $("#panel1").focus();
        $("#panel2").focus();
    var seccion_actual = 0;


    $(document).keydown(function (e) {
        var evtobj = window.event ? event : e
        if (evtobj.keyCode === 90 && evtobj.ctrlKey) {
            if (seccion_actual === 0) {
                seccion_actual++;
            } else if (seccion_actual > count_element) {
                seccion_actual = 1;
            }
            console.log("seccion " + seccion_actual);
            $("#seccion" + seccion_actual).focus();
            seccion_actual++;
        }
    });
    ////////////////////////////////////////////////////////
    
});
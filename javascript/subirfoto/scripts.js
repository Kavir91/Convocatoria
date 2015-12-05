$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length
    var panel_count = $('div[name=panel]').length;
    //////////////////
    $('#errorTipo').hide();
    //////////////////
    $('div[name=Adesc]').hide();
    if (typeof $("#panel2") != 'undefined') {
        $("#panel2").focus();
    } else {
        alert('panel1');
        $("#panel1").focus();
    }

    var seccion_actual = 0;
    var panel_actual = 0;

    $('#Ffoto').on('submit', function () {
        //var patt=/[^.]+$/;//obetener extensión
        var patt = /\.(jpg|jpeg)$/;
        $cad = $('#userfile').val().toLowerCase();
        if ($cad==="") {
             $('#DError1').text("Debes seleccionar un archivo");
            $('#errorTipo').show();
            $("#panel2").focus();
            return false;
        }
        //alert($cad);
        $res = patt.test($cad);
        //alert($res);
        //alert($res);

        if ($('#errorController').type !== "undefined") {
            $('#errorController').remove();
        }

        if ($res === false) {
            $('#DError1').text("El archivo '" + $cad + "' no es válido, por favor seleccione otro archivo.");
            $('#errorTipo').show();
            $("#panel2").focus();
        }
        return $res;
    });


    $(document).keydown(function (e) {
        var evtobj = window.event ? event : e;
        console.log(evtobj.keyCode);
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
    $('input,select').focus(function () {

    });

    //$('#asp_cuantoscontribuyen1').keypress(validateNumber(e));



});
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode == 8 || event.keyCode == 46
            || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if (key < 48 || key > 57) {
        return false;
    }
    else
        return true;
}
;
function inputFocus($id) {
    $('#' + $id).focus();
}

function quitarError($id) {
    //alert($('#errorController').length);
    //alert($id);
    //alert($('#nErrores').val());
    if ($('#errorController').length > 0) {
        if ($('#nErrores').val() >= 1) {
            //alert($('#nErrores').val());
            $('#E' + $id).remove();
            $('#nErrores').val($('#nErrores').val() - 1);
            //alert($('#nErrores').val());
            if ($('#nErrores').val() == 0) {
                $('#errorController').remove();
                //$('#panel2').remove();
            }
        } else {
            //alert("<1");
            //$('#errores').empty();
            $('#errorController').remove();
            //$('#panel2').remove();
        }
    } else {
        $('#errorTipo').hide();
    }


}
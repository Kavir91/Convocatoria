$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length
    var panel_count = $('div[name=panel]').length;
    //////////////////

    //////////////////
    $('div[name=contribuyente]').hide();
    $('div[name=Adesc]').hide();
    $("#instrucciones").focus();
    $('#Idependotros').hide();
    var seccion_actual = 0;
    var panel_actual = 0;

    ajustarSecciones();

    $(document).keydown(function (e) {
        var evtobj = window.event ? event : e
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
//    $('input,select').focus(function () {
//
//    });

    //$('#asp_cuantoscontribuyen1').keypress(validateNumber(e));

    $('#asp_cuantoscontribuyen').change(function () {
        ajustarSecciones();
    });

    function ajustarSecciones() {
        switch ($('#asp_cuantoscontribuyen').val()) {
            case '1':
            {
                $('div[name=contribuyente]').hide();
                $('#contribuyente_1').show();
                break;
            }
            case '2':
            {
                $('div[name=contribuyente]').hide();
                $('#contribuyente_1').show();
                $('#contribuyente_2').show();
                break;
            }
            case '3':
            {
                $('div[name=contribuyente]').hide();
                $('#contribuyente_1').show();
                $('#contribuyente_2').show();
                $('#contribuyente_3').show();
                break;
            }
            case '4':
            {
                $('#contribuyente_1').show();
                $('#contribuyente_2').show();
                $('#contribuyente_3').show();
                $('#contribuyente_4').show();
                $('#contribuyente_5').hide();
                break;
            }
            case '5':
            {
                $('div[name=contribuyente]').show();
                break;
            }
        }
    }

    if ($('#Hasp_mismodom').val() != '') {
        $("[name=asp_mismodom]").val([$('#Hasp_mismodom').val()]);
    }

    $('#dependpadre').attr('checked', checkbox($('#Hdependpadre').val()));
    $('#dependmadre').attr('checked', checkbox($('#Hdependmadre').val()));
    $('#dependhermano').attr('checked', checkbox($('#Hdependhermano').val()));
    $('#dependfamiliares').attr('checked', checkbox($('#Hdependfamiliares').val()));
    $('#dependbeca').attr('checked', checkbox($('#Hdependbeca').val()));
    $('#dependyo').attr('checked', checkbox($('#Hdependyo').val()));
    $('#dependotros').attr('checked', checkbox($('#Hdependotros').val()));
//    $('#dependotros').click(function(){
//        alert('change');
//        if ($('#dependotros').attr('checked')==true) {
//            $('#Idependotros').show();
//        }else{
//            $('#Idependotros').hide();
//        }
//    });

//    if ($('#dependotros').attr('checked') == true) {
//        $('#Idependotros').show();
//    }

    $('input, select').keypress(function (event) {
        if (event.keyCode === 13) {
            return false;
        }
        return true;
    });
    if ($('#Hasp_cuantoscontribuyen').val() != '') {
        if ($('#Hasp_cuantoscontribuyen').val() > 0 && $('#Hasp_cuantoscontribuyen').val() <= 5) {
            $('#asp_cuantoscontribuyen').val($('#Hasp_cuantoscontribuyen').val());
            ajustarSecciones();
        }
    }
    console.log($('#Hasp_cuantoscontribuyen').val());
    $i1 = parseInt($('#Hasp_cuantoscontribuyen').val());

    for ($i = 1; $i < $i1 + 1; $i++) {
        console.log('#sexo_' + $i);
        $('#sexo_' + $i).val($('#Hsexo_' + $i).val());
        $('#parentesco_' + $i).val($('#Hparentesco_' + $i).val());
        $('#ultimogrado_' + $i).val($('#Hultimogrado_' + $i).val());
        $('#asisteescuela_' + $i).val($('#Hasisteescuela_' + $i).val());
        $('#entrabajoes_' + $i).val($('#Hentrabajoes_' + $i).val());
        $('#recibegob_' + $i).attr('checked', checkbox($('#Hrecibegob_' + $i).val()));
        $('#recibejub_' + $i).attr('checked', checkbox($('#Hrecibejub_' + $i).val()));
        $('#recibeotropais_' + $i).attr('checked', checkbox($('#Hrecibeotropais_' + $i).val()));
        $('#recibeestepais_' + $i).attr('checked', checkbox($('#Hrecibeestepais_' + $i).val()));
        $('#recibeotras_' + $i).attr('checked', checkbox($('#Hrecibeotras_' + $i).val()));
    }

    function checkbox($string) {
        if ($string.length > 0) {
            return true;
        } else {
            return false;
        }
    }


});

function inputFocus($id) {
    $('#' + $id).focus();
}

function quitarError($id) {
    //alert($id);
    //alert($('#nErrores').val());
    if ($('#nErrores').val() > 0) {
        //alert($('#nErrores').val());
        $('#E' + $id).remove();
        $('#nErrores').val($('#nErrores').val() - 1);
        //alert($('#nErrores').val());
    } else {
        $('#errores').empty();
        $('#panel2').remove();
    }
}

function onlyNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    alert(key);
    $allowed = [];
    return false;
}

function onlyChar() {

}

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

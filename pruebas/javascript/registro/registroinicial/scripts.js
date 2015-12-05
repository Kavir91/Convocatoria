$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length;
    var panel_count = $('div[name=panel]').length;
    $('div[name=Adesc]').hide();
    $('#panel1').focus();
    $('#panel2').focus();
    var seccion_actual = 0;
    var panel_actual = 0;

    //var base_url = window.location.origin;

    if ($('#Hmesnacimiento').val() !== '') {
        $('#dianacimiento').val($('#Hdianacimiento').val());
        $('#mesnacimiento').val($('#Hmesnacimiento').val());
        $('#asp_nacionalidad').val($('#Hasp_nacionalidad').val());
        $('#asp_paisnacimiento').val($('#Hasp_paisnacimiento').val());
        $('#asp_estadonacimiento').val($('#Hasp_estadonacimiento').val());
        $('#asp_sexo').val($('#Hasp_sexo').val());
        $('#asp_estadocivil').val($('#Hasp_estadocivil').val());

        $('#asp_idpreguntadeseguridad').val($('#Hasp_idpreguntadeseguridad').val());

        $('#car_campus').val($('#Hcar_campus').val());
        $('#car_modalidad').val($('#Hcar_modalidad').val());
        $('#asp_familiarizadoconbraile').val($('#Hasp_familiarizadoconbraile').val());
    }
    muns();
    cars();
    esconder();



    //console.log("CI_ROOT=" + document.mybaseurl);

    $(document).keydown(function (e) {
        var evtobj = window.event ? event : e;
        //console.log(evtobj.keyCode);
        if (evtobj.keyCode === 90 && evtobj.ctrlKey) {
            if (seccion_actual === 0) {
                seccion_actual++;
            } else if (seccion_actual > count_element) {
                seccion_actual = 1;
            }
            console.log("seccion " + seccion_actual);
            $("#seccion" + seccion_actual).focus();
            seccion_actual++;
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
    function esconder(valor) {
        if (valor === true) {
            $("#asp_estadonacimiento").hide();
            $("#asp_municipionacimiento").hide();
            $("#asp_curp").hide();
            $("#Lasp_curp").hide();
            $("#Lasp_municipionacimiento").hide();
            $("#Lasp_estadonacimiento").hide();
        } else if (valor === false) {
            console.log("esconder false");
            $("#asp_estadonacimiento").show();
            $("#asp_municipionacimiento").show();
            $("#asp_curp").show();
            $("#Lasp_curp").show();
            $("#Lasp_municipionacimiento").show();
            $("#Lasp_estadonacimiento").show();
        } else {
            if ($('#asp_nacionalidad').val() === "E") {
                $("#asp_paisnacimiento").val(157);
                esconder(true);
            }
        }
    }
    ////////////////////////////////////////////////////////
    $("#asp_nacionalidad").change(function () {
        $value = $("#asp_nacionalidad").val();
        if ($value === "E") {
            esconder(true);
            $("#asp_estadonacimiento").val(33);
            $("#asp_paisnacimiento").val(157);///////////////////////////////
            muns();

        } else {
            esconder(false);
            $("#asp_estadonacimiento").val(1);
            $("#asp_paisnacimiento").val(99);
            muns();
        }
    });

    ////////////////////////////////////////////////////////
    $("#asp_estadonacimiento").change(function () {
        muns();
    });

    $('input, select').keypress(function (event) {
        if (event.keyCode === 13) {
            return false;
        }
        return true;
    });

    $('#formulario').on('submit', function () {
        return validaSelect();
    });

    $("#car_campus").focus(function () {
        //alert($(this).val());
        cars();
    });

    $("#car_campus").change(function () {
        //alert($(this).val());
        cars();
    });

    $("#car_modalidad").change(function () {
        //alert($(this).val());
        cars();
    });

    ///////////////////////////////////////////////////////////
    $("#asp_paisnacimiento").change(function () {
        console.log("asp_pais nacimiento");
        if ($("#asp_paisnacimiento").val() === "99") {
            $("#asp_estadonacimiento").val(1);
            $("#asp_nacionalidad").val("M");
            muns();
            esconder(false);
        } else {
            $("#asp_estadonacimiento").val(33);
            $("#asp_nacionalidad").val("E");
            muns();
            esconder(true);
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
    /*$("#asp_nombres").val("aaaaaa");
     $("#asp_apellidopaterno").val("bbbbb");
     $("#asp_apellidomaterno").val("ccccc");
     $("#anionacimiento").val("2015");
     //$("#asp_curp").val("AABB921206HVZRRR99");
     $("#asp_lada").val("228");
     $("#asp_telefono").val("123456");
     $("#asp_ladaconfirma").val("228");
     $("#asp_telefonoconfirma").val("123456");
     $("#asp_celular").val("2288123456");
     $("#asp_celularconfirma").val("2288123456");
     $("#asp_email").val("test@test.com");
     $("#asp_emailconfirma").val("test@test.com");
     $("#asp_password").val("123456");
     $("#asp_repassword").val("123456");
     $("#asp_respuestapreguntaseguridad").val("Xalapa");
     $("#asp_modalidad1").val("Escolarizado");*/
});

function inputFocus($id) {
    $('#' + $id).focus();
}

function quitarError($id) {
    //alert($id);
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

function validaSelect() {
    $Nmunicipios = $('#asp_municipionacimiento').children('option').length;
    $Ncarreras = $('#asp_carrera').children('option').length;

    if ($Nmunicipios > 0 && $Ncarreras > 0) {
        if ($('#asp_carrera').val() < 0) {
            return true;
        } else {
            return true;
        }
    } else if ($Nmunicipios <= 0 || $Ncarreras <= 0) {
        //alert($Nmunicipios);
        //alert($Ncarreras);
        if ($Nmunicipios <= 0) {
            console.log('muns=0');
            muns();
        }
        if ($Ncarreras <= 0) {
            console.log('cars=0');
            cars();
        }
    }
    return false;
}

//////////////////////////////////////////////////////////////////
var car_request;
function cars() {
    var $jsontwo = $("#asp_carrera");
    $jsontwo.empty();
    //console.log(document.mybaseurl + "/catalogo/carreras");
    console.log("region=" + $("#car_campus").val() + "&modalidad=" + $("#car_modalidad").val());
    if (typeof (car_request) !== "undefined") {
        //car_request.abort();

    }

    car_request = $.ajax({
        type: "get",
        url: document.mybaseurl + "/catalogo/carreras",
        cache: false,
        data: "region=" + $("#car_campus").val() + "&modalidad=" + $("#car_modalidad").val(),
        success: function (json) {
            //console.log(json);
            try {
                var data = jQuery.parseJSON(json);
                //console.log(JSON.stringify(data));
                $jsontwo.empty();
                for (var idx in data)
                {
                    var id = data[idx];
                    //console.log(id);
                    $jsontwo.append("<option value='" + id["car_id"] + "'>" + id["car_nombrecarrera"] + "</option>");
                }
                console.log("carreras="+data.length);
                if (data.length === 0) {
                    console.log("no hay carreras");
                    $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                }
                if ($('#Hasp_carrera').val() !== '') {
                    $('#asp_carrera').val($('#Hasp_carrera').val());
                    $('#Hasp_carrera').val('');
                }
            } catch (e) {
                //alert('Error al recuperar los datos de las carreras');
                console.log(e);
            }
        },
        error: function (e) {
            //console.log(e);
            //alert('Error al conectarse al servidor (carreras)');
        }
    });
}
/////////////////////////////////////////////////////////////////////////////
function muns() {
    /*if ($("#asp_estadonacimiento").val() === "33") {
     var $jsontwo = $("#asp_municipionacimiento");
     $jsontwo.empty();
     } else {*/
    //console.log("entre a busqueda municipios");
    var $jsontwo = $("#asp_municipionacimiento");
    $jsontwo.empty();
    $.ajax({
        type: "get",
        //url: "../index.php/registro/municipios",
        url: document.mybaseurl + "/catalogo/municipios",
        //url: "http://localhost/ConvocatoriaV2/index.php/registro/municipios",
        cache: false,
        data: $('#asp_estadonacimiento').serialize(),
        success: function (json) {
            //console.log(json);
            try {
                var data = jQuery.parseJSON(json);
                //console.log(JSON.stringify(data));
                for (var idx in data)
                {
                    var id = data[idx];
                    $jsontwo.append("<option value='" + id["mun_id"] + "'>" + id["mun_nombre"] + "</option>");
                }
            } catch (e) {
                alert('Error al recuperar los datos del municipio');
                console.log(e);
            }
            if ($('#Hasp_municipionacimiento').val() !== '') {
                $('#asp_municipionacimiento').val($('#Hasp_municipionacimiento').val());
                $('#Hasp_municipionacimiento').val('');
            }

        },
        error: function (e) {
            //console.log(e);
            //alert('Error al conectarse al servidor (municipios)');
        }
    });
    //}
} 
$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length;
    var panel_count = $('div[name=panel]').length;
    //////////////////
    muns();
    restaurarValores;
    ajustarAsp_motivo();
    //////////////////
    $('div[name=Adesc]').hide();
    $("#instrucciones").focus();
    var seccion_actual = 0;
    var panel_actual = 0;
    
    $('input, select').keypress(function (event) {
        if (event.keyCode === 13) {
            return false;
        }
        return true;
    });

    function restaurarValores() {
        if ($('#Hasp_paisdomicilio').val() !== "") {

            $('#asp_paisdomicilio').val($('#Hasp_paisdomicilio').val());
            $('#asp_estadodomicilio').val($('#Hasp_estadodomicilio').val());

            $('#asp_seguromedico').val($('#Hasp_seguromedico').val());
            $('#asp_religion').val($('#Hasp_religion').val());
            $('#asp_lenguaindigena1').val($('#Hasp_lenguaindigena1').val());
            $('#asp_lenguaindigena2').val($('#Hasp_lenguaindigena2').val());

            $('#asp_discapacidad1').val($('#Hasp_discapacidad1').val());
            $('#asp_motivo_1').val($('#Hasp_motivo_1').val());
            $('#asp_discapacidad5').val($('#Hasp_discapacidad5').val());
            $('#asp_motivo_5').val($('#Hasp_motivo_5').val());
            $('#asp_discapacidad2').val($('#Hasp_discapacidad2').val());
            $('#asp_motivo_2').val($('#Hasp_motivo_2').val());
            $('#asp_discapacidad6').val($('#Hasp_discapacidad6').val());
            $('#asp_motivo_6').val($('#Hasp_motivo_6').val());
            $('#asp_discapacidad3').val($('#Hasp_discapacidad3').val());
            $('#asp_motivo_3').val($('#Hasp_motivo_3').val());
            $('#asp_discapacidad7').val($('#Hasp_discapacidad7').val());
            $('#asp_motivo_7').val($('#Hasp_motivo_7').val());
            $('#asp_discapacidad4').val($('#Hasp_discapacidad4').val());
            $('#asp_motivo_4').val($('#Hasp_motivo_4').val());

            $('#asp_parentesco').val($('#Hasp_parentesco').val());
        }
    }

    function ajustarAsp_motivo() {
        if ($('#asp_discapacidad1').val() === "S") {
            $('#asp_motivo_1').show();
        } else {
            $('#asp_motivo_1').hide();
        }
        if ($('#asp_discapacidad2').val() === "S") {
            $('#asp_motivo_2').show();
        } else {
            $('#asp_motivo_2').hide();
        }
        if ($('#asp_discapacidad3').val() === "S") {
            $('#asp_motivo_3').show();
        } else {
            $('#asp_motivo_3').hide();
        }
        if ($('#asp_discapacidad4').val() === "S") {
            $('#asp_motivo_4').show();
        } else {
            $('#asp_motivo_4').hide();
        }
        if ($('#asp_discapacidad5').val() === "S") {
            $('#asp_motivo_5').show();
        } else {
            $('#asp_motivo_5').hide();
        }
        if ($('#asp_discapacidad6').val() === "S") {
            $('#asp_motivo_6').show();
        } else {
            $('#asp_motivo_6').hide();
        }
        if ($('#asp_discapacidad7').val() === "S") {
            $('#asp_motivo_7').show();
        } else {
            $('#asp_motivo_7').hide();
        }
    }

    $('select[Sdiscapacidad="true"]').each(function ($index, $element) {
        $(this).change(function () {
            ajustarAsp_motivo();
        });
        //alert($(this).attr('name'));
    });

    $("#asp_paisdomicilio").change(function () {
        if ($(this).val() === "99") {
            $("#Dasp_mexico").show();
            $("#Dasp_coloniadomicilio").show();
            $("#DDasp_localidaddomicilio").empty();
            $("#DDasp_localidaddomicilio").append('<select tabindex="50" id="asp_localidaddomicilio" name="asp_localidaddomicilio" class="form-control" aria-describedby="dSsLocAct">\n</select>');
            muns();
            locs();
            cols();
        } else {
            $("#Dasp_mexico").hide();
            $("#Dasp_coloniadomicilio").hide();
            $("#DDasp_localidaddomicilio").empty();
            $("#DDasp_localidaddomicilio").append("<input type='text' class='form-control' id='asp_localidaddomicilio' name='asp_localidaddomicilio'>");
            $("#asp_codigopostal").val("");
        }
    });
//Lasp_areabachillerato
//    $("input[name=asp_estudioenmexico]").click(function () {
//        var c = $(this).val();
//        //alert(c);
//        if (c === "S") {
//            $("#noMex").show();
//            $("#noMexVer").show();
//            $("#bachPais").hide();
//        } else
//        if (c === "N") {
//            $("#noMex").hide();
//            $("#noMexVer").hide();
//            $("#bachPais").show();
//        }
//    });
//    $("input[name=asp_estudioenveracruz]").click(function () {
//        var c = $(this).val();
//        if (c === "S") {
//            $("#noVer").hide();
//            $("#noMex").show();
//            //$("#escVer").show();
//        } else
//        if (c === "N") {
//            $("#noVer").show();
//            $("#noMex").hide();
//            //$("#escVer").hide();
//        }
//    });
//    function ajustaGrados() {
//        var sel = $("input[name=asp_gradoescuela]:checked").val();
//        switch (sel) {
//            case 'I':
//                console.log("es I: " + sel);
//                $("#bachCon").hide();
//                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
//                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
//                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
//                $("#divHide").show();
//                $("#divHide1").show();
//                $("#divsec2").show();
//                $("#divsec3").show();
//                $("#divsec4").show();
//                $("#divsec5").show();
//                $("#divsec6").show();
//                $("#divsec7").show();
//                break;
//            case 'B':
//                console.log("es B: " + sel);
//                $("#bachCon").show();
//                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresaste del bachillerato?");
//                $("#Lasp_areabachillerato").text("¿Cuál área cursaste en el bachillerato?");
//                $("#labelestudioenmexico").text("¿Concluiste tu bachillerato en la República Mexicana?");
//                $("#divHide").show();
//                $("#divHide1").show();
//                $("#divsec2").show();
//                $("#divsec3").show();
//                $("#divsec4").show();
//                $("#divsec5").show();
//                $("#divsec6").show();
//                $("#divsec7").show();
//                break;
//            case 'S':
//                console.log("es S: " + sel);
//                $("#bachCon").hide();
//                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
//                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
//                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
//                $("#divHide").hide();
//                $("#divHide1").hide();
//                $("#divsec2").show();
//                $("#divsec3").hide();
//                $("#divsec4").hide();
//                $("#divsec5").hide();
//                $("#divsec6").hide();
//                $("#divsec7").hide();
//                break;
//            case 'P':
//                console.log("es P: " + sel);
//                $("#bachCon").hide();
//                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
//                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
//                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
//                $("#divHide").hide();
//                $("#divHide1").hide();
//                $("#dparts").hide();
//                $("#divsec2").hide();
//                $("#divsec3").hide();
//                $("#divsec4").hide();
//                $("#divsec5").hide();
//                $("#divsec6").hide();
//                $("#divsec7").hide();
//        }
//
//    }
//    
//    $("input[name=asp_gradoescuela]").on("click", function () {
//        ajustaGrados();
//    });
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
//    $("#listamunicipios").change(function () {
//        escuelas();
//    });
//    $("#listasector").change(function () {
//        escuelas();
//    });
//    $("#listaturnos").change(function () {
//        escuelas();
//    });
    ////////////////////////////////////////////////////////
//    function escuelas() {
//        var a = $("#listamunicipios option:selected").val();
//        var b = $("#listasector option:selected").val();
//        var c = $("#listaturnos option:selected").val();
//        //console.log("municipio seleccionado="+a);
//        console.log("municipio=" + a +
//                "&sector=" + b +
//                "&turno=" + c);
//        var $jsontwo = $("#asp_escueladeprocedencia");
//        $jsontwo.empty();
//        $.ajax({
//            type: "get",
//            url: document.mybaseurl + "/catalogo/escuelas",
//            cache: false,
//            data: "municipio=" + a +
//                    "&sector=" + b +
//                    "&turno=" + c,
//            success: function (json) {
//                //console.log(json);
//                try {
//                    var data = jQuery.parseJSON(json);
//                    for (var idx in data)
//                    {
//                        var id = data[idx];
//                        $jsontwo.append("<option value='" + id.esc_id + "'>" + id.esc_nombre + "</option>");
//                    }
//                    if (data.length === 0) {
//                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
//                    }
//                    if ($('#Hasp_escueladeprocedencia').val() !== '') {
//                        $('#asp_escueladeprocedencia').val($('#Hasp_escueladeprocedencia').val());
//                        $('#Hasp_escueladeprocedencia').val('');
//                    }
//                } catch (e) {
//                    //alert('Error al recuperar los datos de la escuela');
//                    console.log(e);
//                }
//            },
//            error: function (error) {
//                console.log(error);
//                //alert('Error al conectarse al servidor (escuelas)');
//            }
//        });
//    }
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
//    $("#asp_estudioenveracruz1").focus(function () {
//        ests();
//    });
    function ests() {
        console.log('estados');
        var $jsontwo = $("#asp_estadoestudios");
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/estados",
            cache: false,
            success: function (json) {
                //console.log(json);
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        //console.log(id);
                        $jsontwo.append("<option value='" + id.est_id + "'>" + id.est_nombre + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    }
                    if ($('#Hasp_estadoestudios').val() !== '') {
                        $('#asp_estadoestudios').val($('#Hasp_estadoestudios').val());
                        $('#Hasp_estadoestudios').val('');
                    }
                } catch (e) {
                    //alert('Error al recuperar los datos de los estados');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (estados)');
            }
        });
    }

    function pais() {
        var $jsontwo = $("#asp_paisestudios");
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/paises",
            cache: false,
            success: function (json) {
                //console.log(json);
                $jsontwo.empty();
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        //console.log(id);
                        $jsontwo.append("<option value='" + id.pai_id + "'>" + id.pai_nombrecorto + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    } else {
                        $jsontwo.val(157);
                    }

                } catch (e) {
                    //alert('Error al recuperar los datos de los paises');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (pais)');
            }
        });
    }

    $("#asp_estadodomicilio").change(function () {
        muns();
    });
    function muns() {
        var $jsontwo = $("#asp_municipiodomicilio");
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/municipios",
            cache: false,
            data: "asp_estadonacimiento=" + $("#asp_estadodomicilio").val(),
            success: function (json) {
                //console.log(json);
                $jsontwo.empty();
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        //console.log(id);
                        $jsontwo.append("<option clave='" + id.mun_clave + "' value='" + id.mun_id + "'>" + id.mun_nombre + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    } else {

                    }
                    locs();
                    if ($('#Hasp_municipiodomicilio').val() !== '') {
                        $('#asp_municipiodomicilio').val($('#Hasp_municipiodomicilio').val());
                        $('#Hasp_municipiodomicilio').val('');
                    }
                    cols();
                } catch (e) {
                    //alert('Error al recuperar los datos de los municipios');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (municipios)');
            }
        });
    }

//    $("#asp_municipiodomicilio").change(function () {
//        locs();
//    });

    $("#asp_municipiodomicilio").focusout(function () {
        locs();
        cols();
    });
    function locs() {
        var $jsontwo = $("#asp_localidaddomicilio");
        $jsontwo.empty();
        console.log("municipio=" + $("#asp_municipiodomicilio").val());
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/localidades",
            cache: false,
            data: "municipio=" + $("#asp_municipiodomicilio").val(),
            success: function (json) {
                //console.log(json);
                $jsontwo.empty();
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        //console.log(id);
                        $jsontwo.append("<option  value='" + id.loc_id + "'>" + id.loc_nombre + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    } else {

                    }
                    if ($('#Hasp_localidaddomicilio').val() !== '') {
                        $('#asp_localidaddomicilio').val($('#Hasp_localidaddomicilio').val());
                        $('#Hasp_localidaddomicilio').val('');
                    }
                } catch (e) {
                    //alert('Error al recuperar los datos de las localidades');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (localidades)');
            }
        });
    }

    $("#asp_municipiodomicilio").change(function () {
        locs();
        cols();
    });
    function cols() {
        var $jsontwo = $("#asp_coloniadomicilio");
        console.log("municipio=" + $("#asp_municipiodomicilio").val());
        $option = $('#asp_municipiodomicilio').find(":selected").attr("clave");
        $option1 = $('#asp_estadodomicilio').find(":selected").attr("title");
        console.log("municipio=" + $option+"&estado="+$option1);
        //console.log("clave="+($option));
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/colonias",
            cache: false,
            data: "municipio=" + $option+"&estado="+$option1,
            success: function (json) {
                //console.log(json);
                $jsontwo.empty();
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        $jsontwo.append("<option cp='" + id.col_codigopostal + "' value='" + id.col_id + "'>" + id.col_nombrecolonia + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    } else {

                    }
                    $option = $('#asp_coloniadomicilio').find(":selected").attr("cp");
                    $('#asp_codigopostal').val($option);
                    if ($('#Hasp_coloniadomicilio').val() !== '') {
                        $('#asp_coloniadomicilio').val($('#Hasp_coloniadomicilio').val());
                        $('#Hasp_coloniadomicilio').val('');
                    }
                } catch (e) {
                    ///alert('Error al recuperar los datos de las colonias');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (colonias)');
            }
        });
    }

    $("#asp_coloniadomicilio").change(function () {
        $option = $('#asp_coloniadomicilio').find(":selected").attr("cp");
        $('#asp_codigopostal').val($option);
    });
    /*$('div[name=section]:not(.no)').each(function () {
     $(this).html("Found: " + $(this).attr("id"));
     });*/

    /*$('div[name=seccion] *').each(function () {
     alert($(this).text());
     });*/

//    $('#asp_promediosecundaria').val("10.0");
//    //$('#asp_promediobach').val("9.0");
//    $('#asp_aniopresentoexani1').val("2010");
//    $('#asp_codigopostal').val("91070");
//    $('#asp_domicilio').val("calle sin nombre y sin numero");
//
//    $('#asp_nombretutor').val("cris");
//    $('#asp_primerapellidotutor').val("cris");
//    $('#asp_segundoapellidotutor').val("cris");
//    $('#asp_emailtutor').val("a@a.com");
//    $('#asp_emailtutorconfirma').val("a@a.com");
//    $('#asp_ladatutor').val("123");
//    $('#asp_ladatutorconfirma').val("123");
//    $('#asp_telefonotutor').val("7123456");
//    $('#asp_telefonotutorconfirma').val("7123456");
//    $('#asp_celulartutor').val("2288123456");
//    $('#asp_celulartutorconfirma').val("2288123456");
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
function isNumberKey()
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57)) {
        alert(false);
        return false;
    }
    alert(true);
    return true;
}






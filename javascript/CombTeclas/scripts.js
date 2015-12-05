$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length;
    var panel_count = $('div[name=panel]').length;
    //////////////////
    $("#bachCon").hide();
    $("#bachPais").hide();
    $("#noVer").hide();
    //$("#hrSec").hide();
    //////////////////
    $('div[name=Adesc]').hide();

    $('input, select').keypress(function (event) {
        if (event.keyCode === 13) {
            return false;
        }
        return true;
    });
    

    if (typeof $("#panel2") != 'undefined') {
        $("#panel2").focus();
    } else {
        $("#instrucciones").focus();
    }
    var seccion_actual = 0;
    var panel_actual = 0;

    if ($('#Hasp_gradoescuela').val() !== '') {
        $("[name=asp_gradoescuela]").val([$('#Hasp_gradoescuela').val()]);
        //ajustaGrados();
        $('#asp_nopresentoexani1').val($('#Hasp_nopresentoexani1').val());
        if ($('#asp_nopresentoexani1').val() === '0') {//ocultar campos de ano exani
            $('#Dasp_aniopresentoexani1').hide();
        } else {
            $('#Dasp_aniopresentoexani1').show();
        }
        $('#asp_anioingresoselect').val($('#Hasp_anioingresoselect').val());
        $('#asp_mesegresoselect').val($('#Hasp_mesegresoselect').val());
        $('#asp_anioegresoselect').val($('#Hasp_anioegresoselect').val());
        $('#asp_areabachillerato').val($('#Hasp_areabachillerato').val());
        $("[name=asp_estudioenmexico]").val([$('#Hasp_estudioenmexico').val()]);
        var c = $('#Hasp_estudioenmexico').val();
        if (c === "S") {
            $("#noMex").show();
            $("#noMexVer").show();
            $("#bachPais").hide();
        } else
        if (c === "N") {
            $("#noMex").hide();
            $("#noMexVer").hide();
            $("#bachPais").show();
        }

        $("[name=asp_estudioenveracruz]").val([$('#Hasp_estudioenveracruz').val()]);
        c = $('#Hasp_estudioenveracruz').val();
        if (c === "S") {
            $("#noVer").hide();
            $("#noMex").show();
        } else
        if (c === "N") {
            $("#noVer").show();
            $("#noMex").hide();
            //ests();
        }
        $("[name=asp_paisestudios]").val([$('#Hasp_paisestudios').val()]);
        c = $('#Hasp_paisestudios').val();
        if (c === "S") {
            $("#noVer").hide();
            $("#noMex").show();
        } else
        if (c === "N") {
            $("#noVer").show();
            $("#noMex").hide();
            //ests();
        }

        $('#listamunicipios').val($('#Hlistamunicipios').val());
        $('#listasector').val($('#Hlistasector').val());
        $('#listaturnos').val($('#Hlistaturnos').val());
        ajustaGrados();
    }

    escuelas();
    ests();
    pais();
    //muns();
    //cols();
    $("#asp_nopresentoexani1").change(function () {
        if ($(this).val() === "1") {
            $("#Dasp_aniopresentoexani1").show();
        } else {
            $("#Dasp_aniopresentoexani1").hide();
        }
    });

    $("input[name=asp_estudioenmexico]").click(function () {
        var c = $(this).val();
        //alert(c);
        if (c === "S") {
            $("#noMex").show();
            $("#noMexVer").show();
            $("#bachPais").hide();
            //$("[name=asp_paisestudios]").val([99]);
        } else
        if (c === "N") {
            $("#noMex").hide();
            $("#noMexVer").hide();
            $("#bachPais").show();
        }
    });
    $("input[name=asp_estudioenveracruz]").click(function () {
        var c = $(this).val();
        if (c === "S") {
            $("#noVer").hide();
            $("#noMex").show();
            //$("#escVer").show();
        } else
        if (c === "N") {
            $("#noVer").show();
            $("#noMex").hide();
            //$("#escVer").hide();
        }
    });
    function ajustaGrados() {
        var sel = $("input[name=asp_gradoescuela]:checked").val();
        switch (sel) {
            case 'I':
                //console.log("es I: " + sel);
                $("#bachCon").hide();
                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
                $("#divHide").show();
                $("#divHide1").show();
                $("#divsec2").show();
                $("#divsec3").show();
                $("#divsec4").show();
                $("#divsec5").show();
                $("#divsec6").show();
                $("#divsec7").show();
                break;
            case 'B':
                //console.log("es B: " + sel);
                $("#bachCon").show();
                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresaste del bachillerato?");
                $("#Lasp_areabachillerato").text("¿Cuál área cursaste en el bachillerato?");
                $("#labelestudioenmexico").text("¿Concluiste tu bachillerato en la República Mexicana?");
                $("#divHide").show();
                $("#divHide1").show();
                $("#divsec2").show();
                $("#divsec3").show();
                $("#divsec4").show();
                $("#divsec5").show();
                $("#divsec6").show();
                $("#divsec7").show();
                break;
            case 'S':
                //console.log("es S: " + sel);
                $("#bachCon").hide();
                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
                $("#divHide").hide();
                $("#divHide1").hide();
                $("#divsec2").show();
                $("#divsec3").hide();
                $("#divsec4").hide();
                $("#divsec5").hide();
                $("#divsec6").hide();
                $("#divsec7").hide();
                break;
            case 'P':
                //console.log("es P: " + sel);
                $("#bachCon").hide();
                $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
                $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
                $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
                $("#divHide").hide();
                $("#divHide1").hide();
                $("#dparts").hide();
                $("#divsec2").hide();
                $("#divsec3").hide();
                $("#divsec4").hide();
                $("#divsec5").hide();
                $("#divsec6").hide();
                $("#divsec7").hide();
        }
    }

    $("input[name=asp_gradoescuela]").on("click", function () {
        ajustaGrados();
    });
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
    $("#listamunicipios").change(function () {
        escuelas();
    });
    $("#listasector").change(function () {
        escuelas();
    });
    $("#listaturnos").change(function () {
        escuelas();
    });
    ////////////////////////////////////////////////////////
    function escuelas() {
        var a = $("#listamunicipios option:selected").val();
        var b = $("#listasector option:selected").val();
        var c = $("#listaturnos option:selected").val();
        //console.log("municipio seleccionado="+a);
        console.log("municipio=" + a +
                "&sector=" + b +
                "&turno=" + c);
        var $jsontwo = $("#asp_escueladeprocedencia");
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/escuelas",
            cache: false,
            data: "municipio=" + a +
                    "&sector=" + b +
                    "&turno=" + c,
            success: function (json) {
                //console.log(json);
                try {
                    var data = jQuery.parseJSON(json);
                    for (var idx in data)
                    {
                        var id = data[idx];
                        $jsontwo.append("<option value='" + id.esc_id + "'>" + id.esc_nombre + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    }
                    if ($('#Hasp_escueladeprocedencia').val() !== '') {
                        $('#asp_escueladeprocedencia').val($('#Hasp_escueladeprocedencia').val());
                        $('#Hasp_escueladeprocedencia').val('');
                    }
                } catch (e) {
                    //alert('Error al recuperar los datos de la escuela');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                //alert('Error al conectarse al servidor (escuelas)');
            }
        });
    }
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
    $("#asp_estudioenveracruz1").focus(function () {
        //ests();
    });
    $("#asp_estudioenmexico1").focus(function () {
        //pais();
    });
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
                    } else {
                        $('#asp_estadoestudios').val(2);
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
        console.log('pais');
        var $jsontwo = $("#asp_paisestudios");
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/paises",
            cache: false,
            success: function (json) {
                //console.log(json);
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
                    if ($('#Hasp_paisestudios').val() !== '') {
                        $('#asp_paisestudios').val($('#Hasp_paisestudios').val());
                        $('#Hasp_paisestudios').val('');
                    } else {
                        $('#asp_paisestudios').val(157);
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
    if ($('#nErrores').val() >= 1) {
        //alert($('#nErrores').val());
        $('#E' + $id).remove();
        $('#nErrores').val($('#nErrores').val() - 1);
        //alert($('#nErrores').val());
        if ($('#nErrores').val() == 0) {
            $('#panel2').remove();
        }
    } else {
        //alert("<1");
        //$('#errores').empty();
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






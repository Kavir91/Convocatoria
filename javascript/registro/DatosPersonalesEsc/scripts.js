$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length
    var panel_count = $('div[name=panel]').length;
    //////////////////
    $("#bachCon").hide();
    $("#bachPais").hide();
    $("#noVer").hide();
    //$("#hrSec").hide();
    //////////////////
    $('div[name=Adesc]').hide();
    $("#instrucciones").focus();
    var seccion_actual = 0;
    var panel_actual = 0;
    escuelas();
    //ests();
    pais();
    muns();

//Lasp_areabachillerato
    $("input[name=asp_estudioenmexico]").click(function () {
        var c = $(this).val();
        //alert(c);
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

    $("input[name=asp_gradoescuela]").on("click", function () {
        var c = $("input:checked");
        if (c.val() === "I") {
            console.log("es I: " + c.val());
            $("#bachCon").hide();
            $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
            $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
            $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
            $("#divHide").show();
            $("#divHide1").show();
            //$("#divHide2").show();
            //$("#hrSec").hide();
            //$("#dparts").show();
            $("#divsec2").show();
            $("#divsec3").show();
            $("#divsec4").show();
            $("#divsec5").show();
            $("#divsec6").show();
            $("#divsec7").show();
        } else
        if (c.val() === "B") {
            console.log("es B: " + c.val());
            $("#bachCon").show();
            $("#Lasp_mesegresoselect").text("¿En qué mes y año egresaste del bachillerato?");
            $("#Lasp_areabachillerato").text("¿Cuál área cursaste en el bachillerato?");
            $("#labelestudioenmexico").text("¿Concluiste tu bachillerato en la República Mexicana?");
            $("#divHide").show();
            $("#divHide1").show();
            //$("#divHide2").show();
            //$("#hrSec").hide();
            //$("#dparts").show();
            $("#divsec2").show();
            $("#divsec3").show();
            $("#divsec4").show();
            $("#divsec5").show();
            $("#divsec6").show();
            $("#divsec7").show();
        } else
        if (c.val() === "S") {
            console.log("es S: " + c.val());
            $("#bachCon").hide();
            $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
            $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
            $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
            $("#divHide").hide();
            $("#divHide1").hide();
            //$("#divHide2").show();
            //$("#hrSec").show();
            //$("#dparts").hide();
            $("#divsec2").show();
            $("#divsec3").hide();
            $("#divsec4").hide();
            $("#divsec5").hide();
            $("#divsec6").hide();
            $("#divsec7").hide();
        } else
        if (c.val() === "P") {
            console.log("es P: " + c.val());
            $("#bachCon").hide();
            $("#Lasp_mesegresoselect").text("¿En qué mes y año egresarás del bachillerato? ");
            $("#Lasp_areabachillerato").text("¿Cuál área estás cursando en el bachillerato?");
            $("#labelestudioenmexico").text("¿Estudias tu bachillerato en la República Mexicana?");
            $("#divHide").hide();
            $("#divHide1").hide();
            //$("#divHide2").hide();
            //$("#hrSec").hide();
            $("#dparts").hide();
            $("#divsec2").hide();
            $("#divsec3").hide();
            $("#divsec4").hide();
            $("#divsec5").hide();
            $("#divsec6").hide();
            $("#divsec7").hide();
        }
    });

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
        var $jsontwo = $("#escuela");
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
                        $jsontwo.append("<option value='" + idx.esc_id + "'>" + id.esc_nombre + "</option>");
                    }
                    if (data.length === 0) {
                        $jsontwo.append("<option value='" + -1 + "'>" + "No hay registros" + "</option>");
                    }
                } catch (e) {
                    alert('Error al recuperar los datos de la escuela');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (escuelas)');
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
        ests();
    });

    function ests() {
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
                } catch (e) {
                    alert('Error al recuperar los datos de los estados');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (estados)');
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
                    alert('Error al recuperar los datos de los paises');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (pais)');
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
                    //cols();
                } catch (e) {
                    alert('Error al recuperar los datos de los municipios');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (municipios)');
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
                } catch (e) {
                    alert('Error al recuperar los datos de las localidades');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (localidades)');
            }
        });
    }

    $("#asp_municipiodomicilio").change(function () {
        cols();
    });

    function cols() {
        var $jsontwo = $("#asp_coloniadomicilio");
        //console.log("municipio=" + $("#asp_municipiodomicilio").val());
        $option = $('#asp_municipiodomicilio').find(":selected").attr("clave");
        //console.log("clave="+($option));
        $jsontwo.empty();
        $.ajax({
            type: "get",
            url: document.mybaseurl + "/catalogo/colonias",
            cache: false,
            data: "municipio=" + $option,
            success: function (json) {
                //console.log(json);
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
                } catch (e) {
                    alert('Error al recuperar los datos de las colonias');
                    console.log(e);
                }
            },
            error: function (error) {
                console.log(error);
                alert('Error al conectarse al servidor (colonias)');
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
});
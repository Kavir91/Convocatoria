var lastEDP = 0;
var lastEDE = 0;
var lastEDF = 0;
var lastECUE = 0;
var lastEIF = 0;
var lastEIP = 0;
var lastEIC = 0;
var lastESF = 0;
var lastECC = 0;

var dic = [];
dic['DP'] = "datosPersonales";
dic['DE'] = "datosEscolares";
dic['DF'] = "datosFamiliares";
dic['CUE'] = "cuestionario";
dic['IF'] = "imprimirFolio";
dic['IP'] = "imprimirPago";
dic['IC'] = "imprimirCredencial";
dic['SF'] = "subirFotografia";
dic['CC'] = "cambiarCarrera";

$(document).ready(function () {


});


function enviar($id, $seccion, $val, $local_id) {
    //link
    $link = $('#E' + dic[$seccion] + '_' + $local_id);
    //select
    $select = $('#' + dic[$seccion] + '_' + $local_id);
    //hidden
    $hidden = $('#H' + dic[$seccion] + '_' + $local_id);
    $.ajax({
        type: "get",
        //url: "../index.php/registro/municipios",
        url: document.mybaseurl + "/administrador/ajaxupdate/" + $id + "/" + dic[$seccion] + "/" + $val,
        cache: false,
        //data: $('#forma').serialize(),
        success: function (json) {
            console.log('enviar()> ' + json);
//            if (json == "FALSE") {
//                //console.log('error al actualizar ' + $seccion + " del aspirante " + $id);
//                //console.log('#' + dic[$seccion] + '_' + $local_id);
//                $select.val($hidden.val());
//            } else {//respuesta servidor =true;
//                if ($val == 0) {
//                    $link.text("No");
//                    $link.removeClass();
//                    $link.addClass('btn btn-danger');
//                } else {
//                    $link.text("Sí");
//                    $link.removeClass();
//                    $link.addClass('btn btn-success')
//                }
//                $link.show();
//
//                $hidden.val($val);
//                $select.remove();
//            }
            if (json == "TRUE") {
                if ($val == 0) {
                    $link.text("No");
                    $link.removeClass();
                    $link.addClass('btn btn-danger');
                } else {
                    $link.text("Sí");
                    $link.removeClass();
                    $link.addClass('btn btn-success')
                }
                $link.show();

                $hidden.val($val);
                $select.remove();
            } else {
                //console.log('error al actualizar ' + $seccion + " del aspirante " + $id);
                //console.log('#' + dic[$seccion] + '_' + $local_id);
                $select.val($hidden.val());
            }
        },
        error: function (e) {
            //console.log("'" + e.responseText + "'");
            console.log("enviar()> " + e.statusText);
            //alert('Error al conectarse al servidor');
        }
    });
}


//id|seccion
function LinkSwitch($id, $seccion) {
    switch ($seccion) {
        case "DP":
        {
            if (lastEDP > 0) {
                $('#' + dic[$seccion] + '_' + lastEDP).remove();
                $('#E' + dic[$seccion] + '_' + lastEDP).show();
            }
            lastEDP = $id;
            break;
        }
        case "DE":
        {
            if (lastEDE > 0) {
                $('#' + dic[$seccion] + '_' + lastEDE).remove();
                $('#E' + dic[$seccion] + '_' + lastEDE).show();
            }
            lastEDE = $id;
            break;
        }
        case "DF":
        {
            if (lastEDF > 0) {
                $('#' + dic[$seccion] + '_' + lastEDF).remove();
                $('#E' + dic[$seccion] + '_' + lastEDF).show();
            }
            lastEDF = $id;
            break;
        }
        case "CUE":
        {
            if (lastECUE > 0) {
                $('#' + dic[$seccion] + '_' + lastECUE).remove();
                $('#E' + dic[$seccion] + '_' + lastECUE).show();
            }
            lastECUE = $id;
            break;
        }
        case "IF":
        {
            if (lastEIF > 0) {
                $('#' + dic[$seccion] + '_' + lastEIF).remove();
                $('#E' + dic[$seccion] + '_' + lastEIF).show();
            }
            lastEIF = $id;
            break;
        }
        case "IP":
        {
            if (lastEIP > 0) {
                $('#' + dic[$seccion] + '_' + lastEIP).remove();
                $('#E' + dic[$seccion] + '_' + lastEIP).show();
            }
            lastEIP = $id;
            break;
        }
        case "IC":
        {
            if (lastEIC > 0) {
                $('#' + dic[$seccion] + '_' + lastEIC).remove();
                $('#E' + dic[$seccion] + '_' + lastEIC).show();
            }
            lastEIC = $id;
            break;
        }
        case "SF":
        {
            if (lastESF > 0) {
                $('#' + dic[$seccion] + '_' + lastESF).remove();
                $('#E' + dic[$seccion] + '_' + lastESF).show();
            }
            lastESF = $id;
            break;
        }
        case "CC":
        {
            if (lastECC > 0) {
                $('#' + dic[$seccion] + '_' + lastECC).remove();
                $('#E' + dic[$seccion] + '_' + lastECC).show();
            }
            lastECC = $id;
            break;
        }
    }

    $div = $('#Div_' + $seccion + "_" + $id);
    $hidden = $('#H' + dic[$seccion] + '_' + $id);
    $link = $('#E' + dic[$seccion] + '_' + $id);

    $link.hide();

    $cadSelect = '<select class="form-control" id="' + dic[$seccion] + '_' + $id + '" name="' + dic[$seccion] + '_' + $id + '">'
            + '<option value="1">Sí</option>'
            + '<option value="0">No</option>'
            + '</select>';
    $div.append($cadSelect);

    $select = $('#' + dic[$seccion] + '_' + $id);

    $select.val($hidden.val());

    $select.change(function () {
        $val = $('#idaspirante_' + $id).val();
        enviar($val, $seccion, $(this).val(), $id);
    });
}

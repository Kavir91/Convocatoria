var MensajeCurp = '';
$(document).ready(function () {
    console.log("seccion " + seccion_actual);
    var count_element = $('div[name=seccion]').length
    $('div[name=Adesc]').hide();
    $("#panel1").focus();
    $("#panel2").hide();
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
function val() {
    var edit1 = $('#curp');
    edit1.val(trim(edit1.val()).toUpperCase());
    var curp = edit1.val();
    if ($('#curp').val().length < 1) {
        $('#errores').empty();
        MensajeCurp = "El CURP debe tener exactamente 18 caracteres"
        $('#errores').append("<a tabindex=2 class='list-group-item' id='curpError'>" + MensajeCurp + "</a>");
        $('#curpError').click(function () {
            $('#curp').focus();
        });
        $('#curpError').keyup(function (e) {
            var evtobj = window.event ? event : e;
            if (evtobj.keyCode === 13) {
                $('#curp').focus();
            }
        });
        $('#curp').change(function () {
            $('#errores').empty();
            $('#panel2').hide();
        });

        $('#panel2').show();
        $("#panel2").focus();
        return false;
    } else {
        $res = validaCURP2(curp);
        if ($res != true) {
            $('#errores').empty();
            $('#errores').append("<a tabindex=2 class='list-group-item' id='curpError'>" + MensajeCurp + "</a>");
            $('#curpError').click(function () {
                $('#curp').focus();
            });
            $('#curpError').keyup(function (e) {
                var evtobj = window.event ? event : e;
                if (evtobj.keyCode === 13) {
                    $('#curp').focus();
                }
            });
            $('#curp').change(function () {
                $('#errores').empty();
                $('#panel2').hide();
            });
            $('#panel2').show();
            $("#panel2").focus();
            return false;
        } else {
            $('#errores').empty();
            $('#panel2').hide();
            return true;
        }
    }

}

function validaCURP2(curp) {
    var segRaiz = "";
    var digVer = "";
    var lngSuma = 0.0;
    var lngDigito = 0.0;
    var strDigitoVer = "";
    var intFactor = new Array(17);
    var chrCaracter = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

    segRaiz = curp.substring(0, 17);
    digVer = curp.substring(17, 18);

    for (var i = 0; i < 17; i++)
    {
        for (var j = 0; j < 37; j++)
        {
            if (segRaiz.substring(i, i + 1) == chrCaracter.substring(j, j + 1))
            {
                intFactor[i] = j;
            }
        }
    }

    for (var k = 0; k < 17; k++)
    {
        lngSuma = lngSuma + ((intFactor[k]) * (18 - k));
    }

    lngDigito = (10 - (lngSuma % 10));

    if (lngDigito == 10)
    {
        lngDigito = 0;
    }

    var reg = /[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]/;
    if (curp.search(reg))
    {
        MensajeCurp = ("La curp: " + curp + " no es válida, por favor verifíquela ");
        //alert(MensajeCurp);
        return false;

    }

    if (!(parseInt(lngDigito) == parseInt(digVer)))
    {
        MensajeCurp = ("La curp: " + curp + " no es válida, por favor verifíquela ");
        //alert(MensajeCurp);
        return false;
    }
    MensajeCurp = ("La curp: " + curp + " es válida ");
    //alert(MensajeCurp);
    return true;
}
function trim(inputString) {
    return $.trim(inputString);
}

function inputFocus($id) {
    $('#' + $id).focus();
}

function quitarError() {
    $('#errores').empty();
    $('#panel2').hide();

}
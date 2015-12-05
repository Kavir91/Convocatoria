$(document).ready(function () {

    $('#enviar').click(function () {
        enviar();
    });

    function enviar() {
        //var $jsontwo = $("#asp_municipionacimiento");
        //$jsontwo.empty();

        $('#datos').empty();
        $('#datos').append($('#forma').serialize());
        $.ajax({
            type: "post",
            //url: "../index.php/registro/municipios",
            url: "http://licdev.dgaeuv.com/index.php/tyflos/guardadatosescuela",
            cache: false,
            data: $('#forma').serialize(),
            success: function (json) {
                console.log(json);
                $('#resultado').empty();
                $('#resultado').append("'"+json+"'");
                try {
                    //var data = jQuery.parseJSON(json);
                    //console.log(JSON.stringify(data));

                } catch (e) {
                    alert('Error al recuperar la respuesta');
                    console.log(e);
                    $('#resultado').empty();
                    $('#resultado').append("'"+json+"'");
                }
            },
            error: function (e) {
                //console.log(e);
                $('#resultado').empty();
                $('#resultado').append("'"+e.toString()+"'");
                alert('Error al conectarse al servidor');
            }
        });
    }
});
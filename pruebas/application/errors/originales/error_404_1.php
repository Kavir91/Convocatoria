<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Página no encontrada</title>
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min[dark].css">

        <style>
            html {
                height: 100%;
            }
            p.justificado{
                text-align:  justify;
            }
            div.center{
                padding-left: 10px;
                padding-right: 10px;
                position: relative;
                top: 50%;
                transform: translateY(-50%);
                text-align: center;
                //max-width: 800px;
            }
            body{
                font-family: "Lucida Console", Monaco, monospace;
                color: #FFFFFF;
                height: 100%;
                margin: 0;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background: #012799; /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover,  #012799 0%, #070159 100%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#012799), color-stop(100%,#070159)); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* IE10+ */
                background: radial-gradient(ellipse at center,  #012799 0%,#070159 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#012799', endColorstr='#070159',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }
        </style>
        <script>
            $(document).ready(function () {
                $(document).keydown(function (e) {
                    $keys = new Array();
                    for ($i = 48; $i < 106; $i++) {
                        $keys[$i] = $i;
                    }
                    $keys[0] = 0;
                    $keys[13] = 13;
                    $keys[19] = 19;
                    $keys[32] = 32;
                    $keys[45] = 45;
                    //$keys[46]=46;
                    $keys[106] = 106;
                    $keys[107] = 107;
                    $keys[108] = 108;
                    $keys[109] = 109;
                    $keys[110] = 110;
                    $keys[192] = 192;
                    $keys[171] = 171;
                    $keys[173] = 193;
                    $keys[188] = 188;
                    $keys[190] = 190;


                    var evtobj = window.event ? event : e;
                    $char = evtobj.keyCode;
                    console.log($char);

                    if (typeof $keys[$char] !== "undefined") {
                        //alert($keys[$char]);
                        window.location.assign("<?= base_url('index.php/cpanel') ?>");
                    }
                    //alert(evtobj.keyCode);
                    //window.location.reload();  
                    //window.location.assign("<?= base_url('index.php/cpanel') ?>");
                });
            });
        </script>
    </head>
    <body>

        <div class="center">
            <div role="alert">
                <center>
                    <p tabindex="1" style="max-width: 150px;">Error 404</p>
                </center>
                <center>
                    <p class="justificado" tabindex="2" style="max-width: 800px;">La página web solicitó no podido ser localizada en este servidor, porfavor verifique que la ruta sea correcta e intente de nuevo. Si cree que la página es correcta, porfavor notifique al administrador.</p>
                </center>
                <center>
                    <p tabindex="3" style="max-width: 800px;">Presione una tecla para continuar.<blink>_</blink></p>
                </center>
            </div>
        </div>

    </body>
</html>

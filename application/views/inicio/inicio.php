<!DOCTYPE html>
<html lang="es">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "<?php echo base_url() ?>/javascript/cambiarcss.js?V=1"></script>
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>/javascript/inicio/scripts.js"></script>
        <script src="<?php echo base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
        <!--<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min.css">-->
        <script>
            document.mybaseurl = '<?php echo base_url('index.php/registro/'); ?>';
        </script>
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min[dark].css">
        <title>Registro U V</title>
    </head>
    <body class="container">
        <div id="wrapper">
            <div id="controls">
                <a href="#" id="small" accesskey="1">A</a>
                <a href="#" id="medium" accesskey="2" class="selected">A</a>
                <a href="#" id="large" accesskey="3">A</a>
            </div>
        </div>
        <div tabindex="0" id="panel1">
            <h2 role="presentation">Instrucciones:</h2>
            <p>
                Para desplazarte en esta página, debes presionar la tecla tabulador, para avanzar a la siguiente página, debes seleccionar alguna de las opciones que se indican, y presionar la tecla enter.
                Para ajustar el tamaño de letra si eres una persona con baja visión, puedes usar las teclas Alt Shift y un número del 1 al 3.
                Para cambiar el color de contraste, puedes utilizar Shift, Alt y Z.
            </p>
        </div>
        <div>
            <h1 style="text-align: center" role="presentation" tabindex="0" >Convocatoria de ingreso a la Universidad Veracruzana</h1>
            <p tabindex="0">Ésta página es oficial de la Universidad Veracruzana y ha sido adaptada para personas con discapacidad visual.</p>

            <p>Para una navegación óptima, es recomentable utilizar un lector de pantalla.</p>

            <div tabindex="0">
                <h2 role="presentation" >Advertencia:</h2>
                <p>Si se detecta que has realizado el registro a través de éste sistema y no eres una persona con discapacidad visual, tu registro quedará totalmente anulado.</p>
            </div>
        </div>
        <form action="http://www.uv.mx/escolar/licenciatura2015">
            <input  class="btn btn-lg btn-primary btn-block" type="submit" id="btnRegresaSistema" value="No soy una persona con discapacidad visual, he entendido los riesgos y deseo volver al sistema tradicional" tabindex="0">
        </form>
        <br>

        <form action="<?php echo base_url() ?>index.php/inicio/inicioconvocatoria">
            <input  class="btn btn-lg btn-primary btn-block" type="submit" value="Soy una persona con discapacidad visual y deseo acceder a la convocatoria" tabindex="0">
        </form>
    </body>
</html>
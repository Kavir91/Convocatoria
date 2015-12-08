<!DOCTYPE html>
<html lang="es">
    <head>

        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>/javascript/inicio/scripts.js"></script>
        <script src="<?php echo base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
        <!--<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min.css">-->
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min[dark].css">  <!--<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min.css">-->
        <script>
            document.mybaseurl = '<?php echo base_url('index.php/registro/'); ?>';
        </script>
        <title>Convocatoria U V</title>
    </head>
    <body class="container">
        <div id="wrapper">
            <div id="controls">
                <a href="#" id="small" accesskey="1">A</a>
                <a href="#" id="medium" accesskey="2" class="selected">A</a>
                <a href="#" id="large" accesskey="3">A</a>
            </div>
        </div>
        <div  tabindex="0" id="panel1">
            <h2 role="presentation" tabindex="0">Instrucciones:</h2>

            <p tabindex="0">
                Para desplazarte en esta página, debes presionar la tecla tabulador, para avanzar a la siguiente página, debes seleccionar alguna de las opciones que se indican y presionar la tecla enter, para volver a escuchar todo presiona f5.
                Para ajustar el tamaño de letra si eres una persona con baja visión, puedes usar las teclas Alt Shift y un número del 1 al 3.
            </p>
        </div>

        <h1 role="presentation" tabindex="0">PARA LA CONVOCATORIA DE NUEVO INGRESO PERIODO 2015:</h1>
        <p tabindex="0">
            La Universidad Veracruzana, acorde a los lineamientos jurídicos, a nivel internacional (Convención Internacional sobre los Derechos de las Personas con Discapacidad), Nacional (Ley General para la Inclusión de Personas con Discapacidad), Estatal (Ley para la Integración de las Personas con Discapacidad del Estado de Veracruz),  y los propios de las instituciones de Educación Superior (Declaración de Yucatán sobre los Derechos de las Personas con Discapacidad en las Universidades), pone a la disposición de las personas con discapacidad visual, una versión accesible de la convocatoria y la obtención del folio UV, 
            para el registro de aspirantes de nuevo ingreso a las carreras de:
        </p>

        <p tabindex="0">•	Matemáticas</p>
        <p tabindex="0">•	Contaduría</p>
        <p tabindex="0">•	Lengua Francesa</p>
        <p tabindex="0">•	Lengua Inglesa</p>
        <p tabindex="0">•	Lengua y literatua Hispánicas</p>
        <p tabindex="0">•	Derecho</p>
        <p tabindex="0">•	Pedagogía</p>
        <p tabindex="0">•	Ingeniería de Software</p>
        <p tabindex="0">•	Tecnologías Computacionales</p>
        <p tabindex="0">•	Economía</p>
        <p tabindex="0">•	Nutrición</p>
        <p tabindex="0">•	Psicología</p>
        <p tabindex="0">•	Música</p>
        <p tabindex="0">•	Teatro</p>       
        <p tabindex="0">•	Agronegocios Internacionales</p>

        <h3 style="text-align: center" role="presentation" tabindex="0" role="presentation">Selecciona la convocatoria en la que estás interesado</h3>

        <form action="<?php echo base_url() ?>index.php/convocatoria/convocatoriaartes">
            <input  class="btn btn-lg btn-primary btn-block" type="submit" value="Convocatoria Artes y Música" tabindex="0" aria-describedby="info1">
        </form><br>

        <form action="<?php echo base_url() ?>index.php/convocatoria/convocatoriatsu">
            <input  class="btn btn-lg btn-primary btn-block" type="submit" value="Convocatoria nivel Licenciatura " tabindex="0" aria-describedby="info2">
        </form>

        <div id="info1" aria-hidden="true" name = "Adesc">
            Este botón te llevará a la convocatoria de las carreras de artes y música.
        </div>

        <div id="info2" aria-hidden="true" name = "Adesc">
            Este botón te llevará a la convocatoria de nivel licenciatura.
        </div>
    </body>


</html>

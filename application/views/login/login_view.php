<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/login/include/head.html"); ?>
        <title>Registro de Aspirantes 2015</title>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <!-- panel izquierdo -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/login/include/panel_izq.html"); ?>
                    </div>
                </div>
                <!--fin panel izquierdo -->
                <div class="row" >
                    <?php include("application/views/login/include/panel_der.html"); ?>
                </div>
                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/login/include/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->

                <!-- fin panel derecho -->
            </div>
        </div>
        <!-- area descripciones -->
        <?php include("application/views/login/include/descripciones.html"); ?>
        <!-- fin area descripciones -->
    </body>
</html>
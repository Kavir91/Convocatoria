<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/registro/datosPersonales/head.html"); ?>
        <title>Registro de datos personales</title>
    </head>
    <body>
        <div class="container">
            
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/registro/datosPersonales/panel_izq.html"); ?>
                    </div>
                </div>
                <!--fin panel izquierdo -->

                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/registro/datosPersonales/panel_der.html"); ?>
                    <?php include("application/views/registro/datosPersonales/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                <div class="col-md-3">
                    <!--<div class="well">-->
                        
                    <!--</div>-->
                </div>
                <!-- fin panel derecho -->
            </div>
       
        <!-- area descripciones -->
        <?php include("application/views/registro/datosPersonales/descripciones.html"); ?>
        <!-- fin area descripciones -->
    </body>
</html>
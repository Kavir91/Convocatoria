<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/imprimirpago/include/head.html"); ?>
        <title>Registro de datos personales</title>
    </head>
    <body>
        <div class="container">
            
            <div class="row">
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/imprimirpago/include/panel_izq.html"); ?>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="well">-->
                    <?php include("application/views/imprimirpago/include/panel_der.html"); ?>
                    <!--</div>-->
                </div>
                <!--fin panel izquierdo -->

                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/imprimirpago/include/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                
                <!-- fin panel derecho -->
            </div>
        </div>
        <!-- area descripciones -->
        <?php include("application/views/imprimirpago/include/descripciones.html"); ?>
        <!-- fin area descripciones -->
    </body>
</html>

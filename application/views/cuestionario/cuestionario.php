<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/cuestionario/include/head.html"); ?>
        <title>Cuestionario de contexto</title>
    </head>
    <body>
        <div class="container">

            <div class="row">
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/cuestionario/include/panel_izq.html"); ?>
                    </div>
                </div>
                <!--fin panel izquierdo -->
                <?php include("application/views/cuestionario/include/panel_der.html"); ?>
                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/cuestionario/include/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                <div class="col-md-2">
                    <!--<div class="well">-->
                    
                    <!--</div>-->
                </div>
                <!-- fin panel derecho -->
            </div>
        </div>
        <!-- area descripciones -->
        <?php include("application/views/cuestionario/include/descripciones.html"); ?>
        <!-- fin area descripciones -->

        
        
    </body>
</html>
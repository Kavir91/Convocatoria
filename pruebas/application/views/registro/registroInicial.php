<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/registro/registroInicial/head.html"); ?>
        <title>Registro de datos personales</title>
    </head>
    <body>
        <div class="container">
            <!--<div class="row ajustar">-->
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/registro/registroInicial/panel_izq.html"); ?>
                    </div>
                </div>
                <div class="row">
                    <?php include("application/views/registro/registroInicial/panel_der.html"); ?>
                </div>
                <!--fin panel izquierdo -->

                <!-- panel principal -->
                
                <div class="col-md-12">
                    <?php include("application/views/registro/registroInicial/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                <div class="col-md-3">
                    <!--<div class="well">-->
                        
                    <!--</div>-->
                </div>
                <!-- fin panel derecho -->
            <!--</div>-->
        </div>
        <!-- area descripciones -->
        <?php include("application/views/registro/registroInicial/descripciones.html"); ?>
        <!-- fin area descripciones -->
    </body>
</html>
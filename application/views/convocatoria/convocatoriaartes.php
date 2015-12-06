<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/convocatoria/include/head.html"); ?>
        <title>Registro de datos personales</title>
    </head>
    <body>
        <div class="container">
            <div id="wrapper">
                <div id="controls">
                    <a href="#" id="small" accesskey="1">A</a>
                    <a href="#" id="medium" accesskey="2" class="selected">A</a>
                    <a href="#" id="large" accesskey="3">A</a>
                </div>
            </div>
            <div class="row">
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/convocatoria/include/panel_izq.html"); ?>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="well">-->
                    
                    <!--</div>-->
                </div>
                <!--fin panel izquierdo -->

                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/convocatoria/include/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                
                <!-- fin panel derecho -->
            </div>
        </div>
        <!-- area descripciones -->
        <?php include("application/views/convocatoria/include/descripciones.html"); ?>
        <!-- fin area descripciones -->
      
             
    </body>
</html>
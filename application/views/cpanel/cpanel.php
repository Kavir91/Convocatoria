<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("application/views/cpanel/include/head.html"); ?>
        <title>Panel de control del aspirante</title>
    </head>
    <body>
        <div class="container">
            
            <div class="row">
                <!-- panel izquiero -->
                <div class="row" >
                    <div class="well">
                        <?php include("application/views/cpanel/include/panel_izq.html"); ?>
                    </div>
                </div>
                <div class="row">
                    <!--<div class="well">-->
                    <?php include("application/views/cpanel/include/panel_der.html"); ?>
                    <!--</div>-->
                </div>
                <!--fin panel izquierdo -->

                <!-- panel principal -->
                <div class="col-md-12">
                    <?php include("application/views/cpanel/include/panel_central.html"); ?>
                </div>
                <!-- fin panel principal -->

                <!-- panel derecho -->
                
                <!-- fin panel derecho -->
            </div>
        </div>
        <!-- area descripciones -->
        <?php include("application/views/cpanel/include/descripciones.html"); ?>
        <!-- fin area descripciones -->
       
        <nav class="navbar navbar-default" >         
        <center>
                                    
                              <a href="<?php echo base_url('/index.php/login2/logout') ?>" tabindex="100">Cerrar sesión</a></li>
        </center>
        </nav>
                       
             
    </body>
</html>
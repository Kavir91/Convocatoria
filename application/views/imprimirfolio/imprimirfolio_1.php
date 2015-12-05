<!doctype html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>/javascript/login/scripts.js"></script>
        <script src="<?php echo base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
        <link media="print" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/imprimirfoliouv/imprimir.css">
        <link media="screen" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/imprimirfoliouv/estilo.css">
        
        <style type="text/css">
            .tamañofuente{
                font-size: 10pt;
            }
            
        </style>
        <style type="text/css">
            .justificado{
                text-align: justify;
            }
        </style>

    </head>
    <body id="body" > <!--tabindex="0" aria-describedby="bodyd"-->
        <h4  tabindex="2">Fecha</h4>


        <div  tabindex="2"> 
            <div class="tamañofuente">
                <?php
                $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                echo $dias[date('w') - 1] . " " . (date('d') - 1) . " de " . $meses[date('n') - 1] . " del " . date('Y');
                ?>
            </div>
        </div> 
    <center>
        <table class="table table-striped table-bordered" style="width: 75%">
            <thead>
                <tr>
                    <td role="presentation">
                        <p tabindex="20"> Nombre:</p>
                    </td>
                    <td role="presentation">
                        <p tabindex="21"> Apellido Paterno:</p>    
                    </td>
                    <td role="presentation">
                        <p tabindex="22"> Apellido Materno:</p>    
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td tabindex="20" >
                        <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_nombres; ?></p>
                    </td>
                    <td tabindex="21">
                       <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_apellidopaterno; ?></p>
                    </td>
                    <td tabindex="22">
                       <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_apellidomaterno; ?></p>
                    </td>
                </tr>

            </tbody>
        </table>
        <h4 tabindex="23">Datos Aspirante</h4>
        <table class="table table-striped table-bordered" style="width: 75%">
            <thead>
                <tr>
                    <td role="presentation">
                        <p tabindex="30">FolioUV:</p>   
                    </td>
                    <td role="presentation">
                        <p tabindex="31">Correo:</p>
                    </td>
                    <td role="presentation">
                        <p tabindex="32">Carrera solicitada:</p>

                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td tabindex="30">
                        
                        <p><?php echo $this->nativesession->get('asp')->aspirante->folio; ?></p>
                    </td>
                    <td tabindex="31">
                        <p><?php echo $this->nativesession->get('asp')->aspirante->asp_email; ?></p> 
                    </td>
                    <td tabindex="32">
                        <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_nombrecarrera; ?></p> 
                    </td>
                </tr>

            </tbody>
        </table>


    </tbody>
</table>
<table class="table table-striped table-bordered" style="width: 75%">
    <thead>
        <tr>
            <td role="presentation">
                <p tabindex="35"> Región:</p>
            </td>
            <td role="presentation">
                <p tabindex="36">Modalidad: </p>
            </td>
            <td role="presentation">
                <p tabindex="37">Nivel:</p>

            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td tabindex="35">
                <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_nombrecampus; ?></p>
            </td>
            <td tabindex="36">
                <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_modalidad; ?></p>
            </td>
            <td tabindex="37">
                
                <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_nombrenivel; ?></p>
            </td>
        </tr>

    </tbody>
</table>




<h4  tabindex="40">Recordatorio</h4>


<div  tabindex="40" > 
    <div class="justificado">
        <p> IMPRIME EL FOLIO UV, ES TU CLAVE PERSONAL DE ACCESO AL SISTEMA JUNTO CON TU CONTRASEÑA
            ES TU RESPONSABILIDAD EL USO QUE SE HAGA DE ESTE FOLIO Y CONTRASEÑA, RESGUARDALOS.
        </p> 
    </div>
</div>  
<div  tabindex="40" > 
    <div class="justificado">
        <p> Bajo protesta de decir la verdad, manifiesto que los datos que proporciono son verídicos 
            y estoy consciente que al dar información falsa mi trámite de ingreso se cancelará.
        </p> 
    </div>
</div> 
<div  tabindex="40" > 
    <div class="justificado">
        <p> Es responsabilidad del interesado realizar correctamente el registro y concluirlo 
            según las fechas establecidas en la Convocatoria.
        </p> 
    </div>
</div> 


<h4  tabindex="40">Pasos a seguir</h4>


<div  tabindex="40" > 
    <div class="justificado">
        <p> PASO 1 SOLICITAR REGISTRO PARA EXAMEN
        </p> 
    </div>
</div>
<div tabindex="40" > 
    <div class="justificado">
        <p> *IMPRIME TU FOLIO UV
            EN EL PANEL DE SOLICITUDES HAZ CLIC EN EL BOTÓN : IMPRIMIR FOLIO UV
            -INGRESA DATOS ESCOLARES Y PERSONALES
            -CONTESTA EL CUESTIONARIO DE CONTEXTO
            *IMPRIME LA ORDEN DE PAGO
            EN ELLA SE INDICA LA CLAVE DE REFENRENCIA PARA PAGAR EN EL BANCO.
            SOLO LA DEBES DE USAR TÚ, ES PERSANAL, ÚNICA E INTRANSFERÍBLE.

        </p> 
    </div>
</div>


<button  tabindex="50" onclick="window.print();return false;" aria-describedby="info1">IMPRIMIR</button>
<form action="<?php echo base_url() ?>index.php/cpanel">
    <input  type="submit" tabindex="51"   value="REGRESAR" aria-describedby="info2"> 
</form>
</center>
<div id="info1" aria-hidden="true" name = "Adesc">
    este botón te abrira la pagina en pdf lista para imprimir
</div>
<div id="info2" aria-hidden="true" name = "Adesc">
    ESTE BOTÓN TE LLEVARÁ A LA PAGINA DE PROCESO DE INGRESO DE LICENCIATURA Y TSU.
</div>
</body>
</html>
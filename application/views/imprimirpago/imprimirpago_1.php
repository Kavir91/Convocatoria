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
        <h1 tabindex="2" role="presentation">Proceso para imprimir Orden de pago</h1>


        <div class="list-group">
            <a class="list-group-item active list-group-item-info">
                <h3 class="list-group-item-heading" tabindex="2" role="presentation">Fecha</h3>
            </a>


            <div class="list-group-item" tabindex="2" > 
                <p>
                    <?php
                    $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
                    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                    echo $dias[date('w') - 1] . " " . (date('d') - 1) . " de " . $meses[date('n') - 1] . " del " . date('Y');
                    ?>
                </p>
            </div>  
        </div>
        <div class="list-group">

            <div tabindex="3" name="seccion" id="seccion1" class="list-group-item list-group-item-section">
                <h3 class="list-group-item-heading" role="presentation">Seccion 1: Datos del Aspirante</h3>
                <p>
                    Debes presionar el tabulador para entrar en la sección y para desplazarte sobre ella con él tabulador.
                </p>
            </div>

            <center>
                <center>
                    <table class="table table-striped table-bordered" style="width: 75%">
                        <thead>
                            <tr>
                                <td role="presentation">
                                    <p tabindex="2"> Nombre:</p>
                                </td>
                                <td role="presentation">
                                    <p tabindex="2"> Apellido Paterno:</p>    
                                </td>
                                <td role="presentation">
                                    <p tabindex="2"> Apellido Materno:</p>    
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td tabindex="2" >
                                    <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_nombres; ?></p>
                                </td>
                                <td tabindex="2">
                                    <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_apellidopaterno; ?></p>
                                </td>
                                <td tabindex="2">
                                    <p> <?php echo $this->nativesession->get('asp')->aspirante->asp_apellidomaterno; ?></p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <h4 tabindex="2">Datos Aspirante</h4>
                    <table class="table table-striped table-bordered" style="width: 75%">
                        <thead>
                            <tr>
                                <td role="presentation">
                                    <p tabindex="2">FolioUV:</p>   
                                </td>
                                <td role="presentation">
                                    <p tabindex="2">Correo:</p>
                                </td>
                                <td role="presentation">
                                    <p tabindex="2">Carrera solicitada:</p>

                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td tabindex="2">

                                    <p><?php echo $this->nativesession->get('asp')->aspirante->folio; ?></p>
                                </td>
                                <td tabindex="2">
                                    <p><?php echo $this->nativesession->get('asp')->aspirante->asp_email; ?></p> 
                                </td>
                                <td tabindex="2">
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
                                    <p tabindex="2"> Región:</p>
                                </td>
                                <td role="presentation">
                                    <p tabindex="2">Modalidad: </p>
                                </td>
                                <td role="presentation">
                                    <p tabindex="2">Nivel:</p>

                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td tabindex="2">
                                    <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_nombrecampus; ?></p>
                                </td>
                                <td tabindex="2">
                                    <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_modalidad; ?></p>
                                </td>
                                <td tabindex="2">

                                    <p><?php echo $this->nativesession->get('asp')->solicitudes[0]->car_nombrenivel; ?></p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="list-group">

                        <div tabindex="3" name="seccion" id="seccion2" class="list-group-item list-group-item-section" >
                            <h3 class="list-group-item-heading" role="presentation">Sección 2: Para pagar</h3>
                            
                        </div>
                        <div class="list-group-item" tabindex="3" > 
                            <h4 role="presentation">Concepto:</h4>
                            <p>
                                REGISTRO AL EXAMEN
                            </p>
                        </div> 
                        <div class="list-group-item" tabindex="3" > 
                            <h4 role="presentation">Monto:</h4>
                            <p>
                                <?php
                                if ($this->nativesession->get('asp')->aspirante->asp_nacionalidad == 'M') {
                                    echo $this->nativesession->get('asp')->solicitudes[0]->car_costomexicanos;
                                } else {
                                    echo $this->nativesession->get('asp')->solicitudes[0]->car_costoextranjeros;
                                }
                                ?> pesos Moneda Nacional
                            </p>
                        </div> 
                        <div class="list-group-item" tabindex="3" > 
                            <h4 role="presentation">Cuenta:</h4>
                            <p>
                                <?php
                                echo ($this->nativesession->get('asp')->solicitudes[0]->ref_codigo);
                                ?> 
                            </p>
                        </div> 
                        <div class="list-group-item" tabindex="3" > 
                            <h4 role="presentation">CLAVE DE REFERENCIA:</h4>
                            <p>
                                <?php
                                echo ($this->nativesession->get('asp')->solicitudes[0]->ref_codigo);
                                ?>
                            </p>
                        </div> 



                        <div class="list-group-item" tabindex="3" > 
                            <div class="justificado">
                                <p> Confirma que la CLAVE DE REFERENCIA y EL MONTO de este documento coincidan
                                    con la Ref. Alfanumérica  y el Importe Total de tu ficha de desposito Banamex. 
                                </p> 
                            </div>
                        </div>  
                        <div class="list-group-item" tabindex="3" > 
                            <div class="justificado">
                                <h2 role='presentation' tabindex="3">ÚLTIMO DÍA DE PAGO 24 DE MARZO DE 2014</h2>

                                <p> 

                                    Conserva esta orden de pago, es útil para para continuar con el registro y futuras aclaraciones.
                                    Efectuado el pago No se hará ninguna devolución.
                                </p> 
                            </div>
                        </div> 


                        <div class="list-group">

                            <div tabindex="3" name="seccion" id="seccion3" class="list-group-item list-group-item-section" >
                                <h3 class="list-group-item-heading" role="presentation">Sección 3: Pasos a seguir</h3>
                                <p>
                                    Debes presionar el tabulador para entrar en la sección y para desplazarte sobre ella con él tabulador.
                                </p>
                            </div>



                            <div class="list-group-item" tabindex="5" > 
                                <div class="justificado">
                                    <p> PASO 2 ANEXAR LA FOTO E IMPRIMIR CREDENCIAL
                                    </p> 
                                </div>
                            </div>
                            <div class="list-group-item" tabindex="5" > 
                                <div class="justificado">
                                    <p> *Anexa tu foto del 6 de marzo al 20 de abril</p> 
                                    <p> *Prepara archivo con tu foto digital</p>
                                    <p> *Ingresa al portal dos días habiles después de haber pagado</p>
                                    <p>     Usar folio U V y contraseña</p>
                                    <p> *La foto fue revisada. Consulta en el portal si fue aceptada</p>
                                    <p>     Si fue rechazada podrás anexar una nueva foto (límite 20 de abril)</p>
                                    <p> Imprime tu credencial a partir del  11 de Abril y hasta el 1 de Mayo</p>
                                    <p> Con la impresión de la credencial para Examen concluye el registro.
                                        La credencial es el documento que da drerecho a presentar el examen</p>

                                </div>
                            </div>

                        </div>
                        <button  tabindex="50" onclick="window.print();
                                return false;" aria-describedby="info1">IMPRIMIR</button>
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

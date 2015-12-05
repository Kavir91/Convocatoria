<!DOCTYPE html>
<html lang="es">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "<?= base_url('javascript/jquery-1.11.1.min.js') ?>"></script>
        <script src="<?= base_url('javascript/administrador/scripts.js') ?>"></script>
        <script src="<?= base_url('javascript/administrador/catiline.js') ?>"></script>
        <script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
        <!--<link media="all" type="text/css" rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">-->
        <script>
            document.mybaseurl = '<?= base_url('index.php/'); ?>';
        </script>
        <link media="all" type="text/css" rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min[dark].css') ?>">
        <title>Administrador de permisos de aspirantes</title>
    </head>

    <body >
        <h2>Permisos de aspirantes para usar las secciones</h2>
        <input type="hidden" id="cuantos" value="<?= count($aspirantes) ?>">
        <table class="table table table-striped table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>ID</td>
                    <td>Folio</td>
                    <td>servidor</td>

                    <td>Datos personales</td>
                    <td>Datos escolares</td>
                    <td>Datos familares</td>

                    <td>cuestionario de contexto</td>

                    <td>Imprimir folio</td>
                    <td>imprimir pago</td>
                    <td>Imprimir credencial</td>

                    <td>Subir fotografía</td>
                    <td>Cambiar carrera</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                foreach ($aspirantes as $tmp) {
                    ?>
                    <tr>
                        <td style="font-size: 14pt; font-weight: bold"><?= $id ?></td>
                        <td><?= $tmp->idaspirante; ?><input type="hidden" value="<?= $tmp->idaspirante; ?>" id="idaspirante_<?= $id ?>" name="idaspirante_<?= $id ?>"></td>
                        <td><?= $tmp->folioUV; ?><input type="hidden" value="<?= $tmp->folioUV; ?>" id="folioUV_<?= $id ?>" name="folioUV_<?= $id ?>"></td>
                        <td><?php
                            if ($tmp->modoServidor === '0') {
                                echo "<strong>Producción</strong>";
                            } else {
                                echo "Desarrollo";
                            }
                            ?>
                        </td>
                        <td>
                            <input type="hidden" id="HdatosPersonales_<?= $id ?>" value="<?= $tmp->datosPersonales; ?>">

                            <a id="EdatosPersonales_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'DP')" class=" <?php
                            if ($tmp->datosPersonales == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->datosPersonales == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_DP_<?= $id ?>">

                            </div>

                        </td>
                        <td>
                            <input type="hidden" id="HdatosEscolares_<?= $id ?>" value="<?= $tmp->datosEscolares; ?>">

                            <a id="EdatosEscolares_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'DE')" class=" <?php
                            if ($tmp->datosEscolares == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->datosEscolares == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_DE_<?= $id ?>">

                            </div>

                        </td>
                        <td>
                            <input type="hidden" id="HdatosFamiliares_<?= $id ?>" value="<?= $tmp->datosFamiliares; ?>">

                            <a id="EdatosFamiliares_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'DF')" class=" <?php
                            if ($tmp->datosFamiliares == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->datosFamiliares == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_DF_<?= $id ?>">

                            </div>
                        </td>

                        <td>
                            <input type="hidden" id="Hcuestionario_<?= $id ?>" value="<?= $tmp->cuestionario; ?>">

                            <a id="Ecuestionario_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'CUE')" class=" <?php
                            if ($tmp->cuestionario == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->cuestionario == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_CUE_<?= $id ?>">

                            </div>
                        </td>
                        <td>
                            <input type="hidden" id="HimprimirFolio_<?= $id ?>" value="<?= $tmp->imprimirFolio; ?>">

                            <a id="EimprimirFolio_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'IF')" class=" <?php
                            if ($tmp->imprimirFolio == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->imprimirFolio == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_IF_<?= $id ?>">

                            </div>
                        </td>
                        <td>
                            <input type="hidden" id="HimprimirPago_<?= $id ?>" value="<?= $tmp->imprimirPago; ?>">

                            <a id="EimprimirPago_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'IP')" class=" <?php
                            if ($tmp->imprimirPago == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->imprimirPago == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_IP_<?= $id ?>">

                            </div>
                        </td>

                        <td>

                            <input type="hidden" id="HimprimirCredencial_<?= $id ?>" value="<?= $tmp->imprimirCredencial; ?>">

                            <a id="EimprimirCredencial_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'IC')" class=" <?php
                            if ($tmp->imprimirCredencial == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->imprimirCredencial == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_IC_<?= $id ?>">

                            </div>
                        </td>

                        <td>
                            <input type="hidden" id="HsubirFotografia_<?= $id ?>" value="<?= $tmp->subirFotografia; ?>">

                            <a id="EsubirFotografia_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'SF')" class=" <?php
                            if ($tmp->subirFotografia == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->subirFotografia == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_SF_<?= $id ?>">

                            </div>
                        </td>

                        <td>
                            <input type="hidden" id="HcambiarCarrera_<?= $id ?>" value="<?= $tmp->cambiarCarrera; ?>">

                           <a id="EcambiarCarrera_<?= $id ?>" onclick="LinkSwitch(<?= $id ?>, 'CC')" class=" <?php
                            if ($tmp->cambiarCarrera == 0) {
                                echo "btn btn-danger";
                            } else {
                                echo "btn btn-success";
                            }
                            ?>">


                                <?php
                                if ($tmp->cambiarCarrera == 0) {
                                    echo 'No';
                                } else {
                                    echo 'Sí';
                                }
                                ?>
                            </a>
                            <div id="Div_CC_<?= $id ?>">

                            </div>
                        </td>
                    </tr>

                    <?php
                    $id++;
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
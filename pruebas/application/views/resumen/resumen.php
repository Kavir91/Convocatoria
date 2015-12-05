<!DOCTYPE html>
<html lang="es">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "<?php echo base_url('javascript/jquery-1.11.1.min.js') ?>"></script>
        <script src="<?php echo base_url('javascript/inicio/scripts.js') ?>"></script>
        <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
        <!--<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min.css">-->
        <script>
            document.mybaseurl = '<?php echo base_url('index.php/registro/'); ?>';
        </script>
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min[dark].css') ?>">
        <title>Resumen de aspirantes</title>
    </head>

    <body >
        <h2>Registrados</h2>
        <table class="table table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Núm</td>
                    <td>ID</td>
                    <td>Folio UV</td>
                    <td>F. registro</td>
                    <td>Carrera</td>
                    <td>Nombre</td>
                    <td>A. Paterno</td>
                    <td>A. Materno</td>
                    <td>F. Nacimiento</td>
                    <td>CURP</td>
                    <td>País</td>
                    <td>Estado</td>
                    <td>Municipio</td>
                    <td>Localidad</td>
                    <td>Domicilio</td>
                    <td>Colonia</td>
                    <td>CP</td>
                    <td>Telefono</td>
                    <td>Celular</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                foreach ($aspirante as $tmp) {
                    ?>
                    <tr>
                        <td style="font-size: 14pt; font-weight: bold"><?= $id ?></td>
                        <td><?= $tmp->asp_id; ?></td>
                        <td><?= $tmp->asp_foliouvclave; ?></td>
                        <td><?= $tmp->asp_fecharegistro; ?></td>
                        <td><?= $tmp->carrera; ?></td>
                        <td><?= $tmp->asp_nombres; ?></td>
                        <td><?= $tmp->asp_apellidopaterno; ?></td>
                        <td><?= $tmp->asp_apellidomaterno; ?></td>
                        <td><?= $tmp->asp_fechanacimiento; ?></td>
                        <td><?= $tmp->asp_curp; ?></td>
                        <td><?= $tmp->asp_paisnacimiento; ?></td>
                        <td><?= $tmp->asp_estadodomicilio; ?></td>
                        <td><?= $tmp->asp_municipiodomicilio; ?></td>
                        <td><?= $tmp->asp_localidaddomicilio; ?></td>
                        <td><?= $tmp->asp_domicilio; ?></td>
                        <td><?= $tmp->asp_colonia; ?></td>
                        <td><?= $tmp->asp_codigopostal; ?></td>
                        <td><?= $tmp->asp_lada . " " . $tmp->asp_telefono; ?></td>
                        <td><?= $tmp->asp_celular; ?></td>
                        <td><?= $tmp->asp_email; ?></td>
                    </tr>

                    <?php
                    $id++;
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <script src= "http://localhost/convocatoriav2/javascript/jquery-1.11.1.min.js"></script>

        <script src="http://localhost/convocatoriav2/bootstrap/js/bootstrap.min.js"></script>
        <link media="all" type="text/css" rel="stylesheet" href="http://localhost/convocatoriav2/bootstrap/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Clave</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Municipio</b></td>
                        <td><b>Turno</b></td>
                        <td><b>Sector</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($escuelas as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->id ?></td>
                            <td><?php echo $value->clave ?></td>
                            <td><?php echo $value->nombre ?></td>
                            <td><?php echo $value->municipio ?></td>
                            <td><?php echo $value->turno ?></td>
                            <td><?php echo $value->sector ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<html>
    <head>
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>/javascript/tmp/scripts.js"></script>
        <title>Envío por AJAX</title>
    </head>
    <body><br><br><br>
        <form id="forma">
            <label>id_usuario </label><input ID="id_usuario" name="id_usuario" placeholder="id_usuario" value="116"><br>
            <label>asp_escueladeprocedencia </label><input ID="asp_escueladeprocedencia" name="asp_escueladeprocedencia" placeholder="asp_escueladeprocedencia" value="706"><br>
            <label>asp_anioingresobachillerato </label><input ID="asp_anioingresobachillerato" name="asp_anioingresobachillerato" placeholder="asp_anioingresobachillerato" value="2011"><br>
            <label>asp_anioegresobachillerato </label><input ID="asp_anioegresobachillerato" name="asp_anioegresobachillerato" placeholder="asp_anioegresobachillerato" value="2014"><br>
            <label>asp_mesegresobachillerato </label><input ID="asp_mesegresobachillerato" name="asp_mesegresobachillerato" placeholder="asp_mesegresobachillerato" value="08"><br>
            <label>asp_areabachillerato </label><input ID="asp_areabachillerato" name="asp_areabachillerato" placeholder="asp_areabachillerato" value="1"><br>
            <label>asp_gradoescuela </label><input ID="asp_gradoescuela" name="asp_gradoescuela" placeholder="asp_gradoescuela" value="I"><br>
            <label>asp_paisestudios </label><input ID="asp_paisestudios" name="asp_paisestudios" placeholder="asp_paisestudios" value="157"><br>
            <label>asp_estadoestudios </label><input ID="asp_estadoestudios" name="asp_estadoestudios" placeholder="asp_estadoestudios" value="1"><br>
            <label>asp_promediosecundaria </label><input ID="asp_promediosecundaria" name="asp_promediosecundaria" placeholder="asp_promediosecundaria" value="5"><br>
            <label>asp_promediobach </label><input ID="asp_promediobach" name="asp_promediobach" placeholder="asp_promediobach" value="10"><br>
            <label>asp_nopresentoexani1 </label><input ID="asp_nopresentoexani1" name="asp_nopresentoexani1" placeholder="asp_nopresentoexani1" value="1"><br>
            <label>asp_aniopresentoexani1 </label><input ID="asp_aniopresentoexani1" name="asp_aniopresentoexani1" placeholder="asp_aniopresentoexani1" value="2012"><br>

            <label>user </label><input ID="user" name="user" placeholder="user" value="ProyectoInvidentes2015"><br>
            <label>password </label><input ID="password" name="password" placeholder="password" value="Pr0y3ct01nv1d3nt35"><br>
        </form>
        <button id="enviar">enviar</button><br>
        <p>datos</p>
        <div id="datos"></div>
        
        <p>Resultado:</p>
        <div id="resultado"></div>
    </body>
</html>
<html>
    <head>
        <script src= "<?php echo base_url() ?>/javascript/jquery-1.11.1.min.js"></script>
        <title>pruebas</title>
    </head>
    <body>
        <script>
            function error(){
               $("<p tabindex=0 role='alert'>hubo un error</p>").appendTo(document.body);
            }
        
        </script>
        <p>
            texto de ejemplo
        </p>
        <button onclick="error()">clic</button>
        
    </body>
</html>
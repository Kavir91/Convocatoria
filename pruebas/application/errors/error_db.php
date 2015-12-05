<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error de base de datos</title>
        <style type="text/css">

            ::selection{ background-color: #E13300; color: white; }
            ::moz-selection{ background-color: #E13300; color: white; }
            ::webkit-selection{ background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #fff;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
            }

            p {
                margin: 12px 15px 12px 15px;
            }
        </style>

        <style>
            html {
                height: 100%;
            }
            p.justificado{
                text-align:  justify;
            }
            div.center{
                padding-left: 10px;
                padding-right: 10px;
                position: relative;
                top: 50%;
                transform: translateY(-50%);
                text-align: center;
                //max-width: 800px;
            }
            body{
                font-family: "Lucida Console", Monaco, monospace;
                color: #FFFFFF;
                height: 100%;
                margin: 0;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background: #012799; /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover,  #012799 0%, #070159 100%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#012799), color-stop(100%,#070159)); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover,  #012799 0%,#070159 100%); /* IE10+ */
                background: radial-gradient(ellipse at center,  #012799 0%,#070159 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#012799', endColorstr='#070159',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1><?php echo $heading; ?></h1>
            <?php echo $message; ?>
        </div>
    </body>
</html>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class webservice {

    //0 = producción
    //1 = desarrollo
    private $modo = 0;

    function getModo() {
        return $this->modo;
    }

    function post($ruta, $datos) {
        //echo $ruta . "<br>";
        $datos["user"] = "ProyectoInvidentes2015";
        $datos["password"] = "Pr0y3ct01nv1d3nt35";
        $CI = & get_instance();
        $CI->load->library('curl');
        $CI->curl->create($ruta);
        $CI->curl->option(CURLOPT_POST, 1);
        $CI->curl->option('buffersize', 10);
        $CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
        $CI->curl->option('returntransfer', 1);
        $CI->curl->option('followlocation', 1);
        $CI->curl->option('HEADER', FALSE);
        $CI->curl->option('POSTFIELDS', $datos);
        $CI->curl->option('connecttimeout', 600);
        $data = $CI->curl->execute();
//        echo "<hr>";
//        var_dump($data);
//        echo "<hr>";
        return json_decode($data);
    }

    function post_img($ruta, $img) {
        //echo $ruta . "<br>";
        $datos['Filedata'] = "@$img;type=image/jpeg";
//        $datos['userfile']="@$img;type=image/jpeg";
//        $datos['userfile']="$img";
        //var_dump($datos);
        $CI = & get_instance();
        $CI->load->library('curl');
        $CI->curl->create($ruta);
        $CI->curl->option(CURLOPT_POST, 1);
        $CI->curl->option('buffersize', 10);
        $CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
        $CI->curl->option('returntransfer', 1);
        $CI->curl->option('followlocation', 1);
        $CI->curl->option('HEADER', FALSE);
        $CI->curl->option('POSTFIELDS', $datos);
        $CI->curl->option('connecttimeout', 1200);
        $data = $CI->curl->execute();
//        echo "<hr>";
//        var_dump($data);
//        echo "<hr>";
        return ($data);
    }

    function get($ruta) {
        $CI = & get_instance();
        $CI->load->library('curl');
        $CI->curl->create($ruta);
        $CI->curl->option('buffersize', 10);
        $CI->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
        $CI->curl->option('returntransfer', 1);
        $CI->curl->option('followlocation', 1);
        $CI->curl->option('HEADER', FALSE);
        $CI->curl->option('connecttimeout', 1200);
        $data = $CI->curl->execute();
        return $data;
    }

    /*
     * revisado
     */

    function guardaregistroinicial($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/guardaregistroinicial';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardaregistroinicial';
        }
        return $this->post($ruta, $data);
    }

    /*
     * revisado
     */

    function recuperarRegistro($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/recuperarRegistro';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/recuperarRegistro';
        }
        return $this->post($ruta, $data);
    }

    /*
     * metodo para vista donde se muestran todos los datos
     */

    function recuperarRegistroDEV($data) {
        $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/recuperarRegistro';

        return $this->post($ruta, $data);
    }

    /*
     * revisado
     */

    function checklogin($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/checklogin';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/checklogin';
        }
        return $this->post($ruta, $data);
    }

    /*
     * revisado en lic dev, falta produccion
     */

    function guardadatosescuela($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/guardadatosescuela';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardadatosescuela';
        }
        return $this->post($ruta, $data);
    }

    /*
     * revisado en lic dev, falta produccion
     */

    function guardadatosparticulares($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/guardadatosparticulares';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardadatosparticulares';
        }
        return $this->post($ruta, $data);
    }

    /*
     * funciona localhost, checar en producción 
     */

    function checarfoto($id, $img_path) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/checarfoto/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/checarfoto/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        }
        return $this->post_img($ruta, $img_path);
    }

    /*
     * Ejecutar primero checarfoto()
     * funciona localhost, checar en producción
     */

    function confirmafoto($id) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/confirmafoto/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/confirmafoto/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        }
        return $this->get($ruta, $id);
    }

    /*
     * Guarda respuesta de una pregunta del cuestionario de contexto
     * asp_id: ID del aspirante
     * cue_numeropregunta: ID de la pregunta
     * cor_id: ID de la opción de respuesta seleccionada
     */

    function guardarPregunta($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/guarda';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guarda';
        }
        return $this->post($ruta, $data);
    }

    /*
     * Devuelve la información de la pregunta, texto a mostrar, opciones de respuesta y IDS
     * Odenpregunta: Numero de pregunta
     * asp_id: ID del aspirante
     * exani: Version de exani
     */

    function opcionesPregunta($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/opciones';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/opciones';
        }
        return $this->post($ruta, $data);
    }

    /*
     * Recupera las respuestas del cuestionario de contexto de un aspirante
     * asp_id
     * exani: Version de exani
     */

    function respuestasAspirante($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/lista';
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/lista';
        }
        return $this->post($ruta, $data);
    }

    /*
     * redirecciona a la vista para la impresión de la credencial, asegurarse de haber comprobado correctamente la fotografía.
     * asp_id
     * numPago
     */

    function credencial($id, $numPago) {
        if ($this->modo === 0) {//modo producción
            $ruta = 'http://lic2015.dgaeuv.com/index.php/tyflos/imprimirCredencial/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35/' . $numPago;
        } else {//modo desarrollo
            $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/imprimirCredencial/' . $id . '/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35/' . $numPago;
        }
        return $this->get($ruta);
    }

    /*
     * redirecciona a la vista para la impresión de la orden pago.
     * asp_id
     * Número de solicitud, default 0
     */

    function ordenPago($id, $numSol = 0) {
        if ($this->modo === 0) {//modo producción
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/imprimir_pago/" . $numSol . "/" . $id;
        } else {//modo desarrollo
            $ruta = "http://licdev.dgaeuv.com/index.php/tyflos/imprimir_pago/" . $numSol . "/" . $id;
        }
        return $this->get($ruta);
    }

    /*
     * redirecciona a la vista para la impresión del folio UV.
     * asp_id
     * Número de solicitud, default 0
     */

    function folioUV($id, $numSol = 0) {
        if ($this->modo === 0) {//modo producción
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/imprimir_folio/" . $numSol . "/" . $id;
        } else {//modo desarrollo
            $ruta = "http://licdev.dgaeuv.com/index.php/tyflos/imprimir_folio/" . $numSol . "/" . $id;
        }
        return $this->get($ruta);
    }

    /*
     * recupera todos los datos de todos los aspirantes
     */

    function getAsp() {
        if ($this->modo === 0) {//modo producción
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/get_foliosdadosTyflos";
        } else {//modo desarrollo
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/get_foliosdadosTyflos";
        }
        return $this->get($ruta);
    }

    /*
     * actualizar datos familiares
     */

    function guardaDatosFamiliares($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/guardaDatosFamiliares";
        } else {//modo desarrollo
            $ruta = "http://licdev.dgaeuv.com/index.php/tyflos/guardaDatosFamiliares";
        }
        return $this->post($ruta, $data);
    }

    /*
     * $curp
     */

    function valRegistroExistente($data) {
        if ($this->modo === 0) {//modo producción
            $ruta = "http://lic2015.dgaeuv.com/index.php/tyflos/contarRegistrosPorCurp";
        } else {//modo desarrollo
            $ruta = "http://licdev.dgaeuv.com/index.php/tyflos/contarRegistrosPorCurp";
        }
        return $this->post($ruta, $data);
    }

}

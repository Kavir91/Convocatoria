<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class webservice_dev {

    function post($ruta, $datos) {
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
        return json_decode($data);
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
        $CI->curl->option('connecttimeout', 600);
        $data = $CI->curl->execute();
        return $data;
    }

    function guardaregistroinicial($data) {
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardaregistroinicial';
        return $this->post($ruta, $data);
    }

    function recuperarRegistro($data) {
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/recuperarRegistro';
        return $this->post($ruta, $data);
    }

    function checklogin($data) {
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/checklogin';
        return $this->post($ruta, $data);
    }
    
    function guardadatosescuela($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardadatosescuela';
        return $this->post($ruta, $data);
    }
    
    function guardadatosparticulares($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guardadatosparticulares';
        return $this->post($ruta, $data);
    }
    
    function confirmafoto($id){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/confirmafoto/'+$id+'/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        return $this->get($ruta);
    }
    
    function checarFoto($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/checarfoto/'+$id+'/ProyectoInvidentes2015/Pr0y3ct01nv1d3nt35';
        return $this->post($ruta, $data);
    }
    
    function guardarPregunta($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/guarda';
        return $this->post($ruta, $data);
    }
    
    function opcionesPregunta($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/opciones';
        return $this->post($ruta, $data);
    }

    function respuestasAspirante($data){
        $ruta = 'http://licdev.dgaeuv.com/index.php/tyflos/lista';
        return $this->post($ruta, $data);
    }
}

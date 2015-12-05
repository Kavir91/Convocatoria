<?php

class aspirante extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function find($id) {
        $query = 'select * from aspirante where idaspirante = %s';
        $res = $this->db->query(sprintf($query, $id));
        $result = $res->result();
        return $result;
    }

    function add($id, $folioUV, $serverModo, $AllSections = false) {
        $res = false;
        if ($AllSections === FALSE) {
            $query = 'INSERT INTO aspirante (idaspirante,folioUV,modoServidor) VALUES (%s,%s,%s);';
            $res = $this->db->query(sprintf($query, $id, $folioUV, $serverModo));
        } else {
            $query = 'INSERT INTO aspirante(`idaspirante`,`folioUV`,`modoServidor`,`datosPersonales`,`datosEscolares`,`datosFamiliares`,`cuestionario`,`imprimirFolio`,`imprimirPago`,`imprimirCredencial`,`subirFotografía`,`cambiarCarrera`)
VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)';


            $res = $this->db->query(sprintf($query, $id, $folioUV, $serverModo, 1, 1, 1, 1, 1, 1, 1, 1, 1));
        }

        return $res;
    }

    function update($id, $seccion, $value, $fecha = 'NULL') {
        if ($fecha != 'NULL') {
            $fecha_1 = '"' . $fecha . '"';
            $fecha = $fecha_1;
        }
        $query = "";
        $res = false;
        //update aspirante set modoServidor=0, datosEscolares_fecha=null where idaspirante=0;
        //$query = sprintf('update aspirante set %s = %s where idaspirante = %s', $seccion, $value, $id);
        $query = sprintf('update aspirante set %s = %s, %s_fecha = %s where idaspirante = %s', $seccion, $value, $seccion, $fecha, $id);

        try {
            $res = $this->db->query($query);
        } catch (Exception $ex) {
            $res = false;
        }
        return $res;
        //return $query;
    }
    function update_1($id, $seccion, $value, $fecha = 'NULL') {
        if ($fecha != 'NULL') {
            $fecha_1 = '"' . $fecha . '"';
            $fecha = $fecha_1;
        }
        $query = "";
        $res = false;
        //update aspirante set modoServidor=0, datosEscolares_fecha=null where idaspirante=0;
        //$query = sprintf('update aspirante set %s = %s where idaspirante = %s', $seccion, $value, $id);
        $query = sprintf('update aspirante set %s = %s, %s_fecha = %s where idaspirante = %s', $seccion, $value, $seccion, $fecha, $id);

        try {
            $res = $this->db->query($query);
        } catch (Exception $ex) {
            $res = false;
        }
        //return $res;
        return $query;
    }

    function all() {
        $CI = & get_instance();

        $query = 'select * from aspirante';
        $res = $this->db->query($query);
        $result = $res->result();
        return $result;
    }

}

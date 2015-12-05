<?php

class respuestas extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function find($id) {
        $query = 'select r.cor_id, cor_pregunta ,r.cor_textorespuesta,cor_value  from respuestas r, preguntas p where p.cup_id=2 and r.cor_pregunta=%s and p.cup_numeropregunta and r.cor_exani=2';
        $res = $this->db->query(sprintf($query, $id));
        return $res->result();
    }

}

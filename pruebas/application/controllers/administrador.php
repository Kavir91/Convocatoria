<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrador
 *
 * @author Cristhian
 */
class administrador extends CI_Controller {

    public function index() {
        $this->load->model('asp/aspirante');
        $res = $this->aspirante->all();
        $data['aspirantes'] = $res;
        $this->load->view('administrador/administrador', $data);
    }

    public function ajaxUpdate($id = 0, $seccion = "", $val) {
        //echo "Server> " . $id . " - " . $seccion . " - " . $val;
        $this->load->model('asp/aspirante');
        $res = $this->aspirante->update($id, $seccion, $val);
        if ($res == TRUE) {
            echo "TRUE";
        } else {
            echo "FALSE";
        }
    }
    public function update($id = 0, $seccion = "", $val) {
        //echo "Server> " . $id . " - " . $seccion . " - " . $val;
        $this->load->model('asp/aspirante');
        echo $res = $this->aspirante->update($id, $seccion, $val);
        if ($res == TRUE) {
            echo "TRUE";
        } else {
            echo "FALSE";
        }
    }

}

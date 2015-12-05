<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of credencial
 *
 * @author Cristhian
 */
class credencial extends CI_Controller {

    //put your code here

    public function index() {
//        echo "trabajando en esto";
        $this->load->view('credencial/credencial');
    }

    public function imprimir() {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }

        $this->load->library('webservice');

        $asp = $this->nativesession->get('asp');
        $codigo = $asp->solicitudes[0]->ref_codigo;

        echo $this->webservice->credencial($user->id_usuario, $codigo);
    }

}

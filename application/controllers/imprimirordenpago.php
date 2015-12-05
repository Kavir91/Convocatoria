<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class imprimirordenpago extends CI_Controller {

    public function index() {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        $this->load->view('imprimirpago/imprimirpago');
    }

    public function imprimirpago() {
        //<form action="http://licdev.dgaeuv.com/index.php/tyflos/imprimir_pago/0/<?php echo ($this->nativesession->get('asp')->solicitudes[0]->fol_id);";
        $user = $this->nativesession->get('user');
        $asp = $this->nativesession->get('asp');
        if ($user == NULL || $asp == NULL) {
            redirect('/login2');
            return;
        }
        $this->load->library('webservice');
        echo $this->webservice->ordenPago($user->id_usuario, 0);
    }

}

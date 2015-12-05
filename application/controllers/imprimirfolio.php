<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class imprimirfolio extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {

        $asp = $this->nativesession->get('asp');
        $ap = $asp->solicitudes[0];
        $asp = $this->nativesession->set('carrera', $ap);

        $this->session->set_userdata('carrera', $ap);

        $this->load->view('imprimirfolio/imprimirfolio');
    }

    public function imprimir() {
        //action="http://licenciatura2015.dgaeuv.com/index.php/tyflos/imprimir_folio/0/<?php echo ($this->nativesession->get('asp')->solicitudes[0]->fol_id);"
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }

        $this->load->library('webservice');
        echo $this->webservice->folioUV($user->id_usuario);
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cPanel extends CI_Controller {

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
        $user = $this->nativesession->get('user');
        //$asp=$this->nativesession->get('asp');
        if ($user === null) {
            redirect('/login2', 'refresh');
        } else {
            //$data['user']=$user;
            /* $asp=$this->session->userdata('asp');
              echo $asp;
              if ($asp!=null) {
              $data['asp']=$asp;
              }
              echo implode($data); */

            $res = array();
            //echo $user->id_usuario."<br>";
            try {
                $this->load->model('asp/aspirante');
                $res = $this->aspirante->find($user->id_usuario);
            } catch (Exception $ex) {
                echo "error al recuperar permisos";
            }

            $data['permisos'] = $res;
            $this->load->view('cpanel/cpanel', $data);
        }
    }

}

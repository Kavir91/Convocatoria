<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login2 extends CI_Controller {

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
        $this->load->view('login/login_view');
    }

    public function login() {
        $postData = $this->input->post();

        $this->load->library('webservice');
        $user = $this->webservice->checklogin($postData);
        //echo var_dump($user);echo"<br><br>";
        $id = $user->id_usuario;
        $name = $user->usuario;
        $estatus = $user->estatus;
        $mensaje = $user->mensaje;

        $rec['id_usuario'] = $id;
        //echo json_encode($this->webservice->recuperarRegistro($rec));

        $username = $this->input->post('foliouv');
        $password = $this->input->post('contrasena');
        if ($username != false && $password != false) {

            if ($estatus == "OK") {
                $this->nativesession->set('user', $user);
                $asp = $this->webservice->recuperarRegistro($rec);
                //$asp = Aspirante::findbyidUser($user->id);
                if ($asp != null) {
                    $this->nativesession->set('asp', $asp);
                }
                redirect('/cpanel', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Porfavor revisa tus datos de inicio de sesión, e intenta nuevamente');
                redirect('/login2', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Porfavor llena todos los campos con tus datos de inicio de sesión, e intenta nuevamente');
            redirect('/login2', 'refresh');
        }
    }

    public function logout() {
        $this->nativesession->SessionDestroy();
        $this->session->sess_destroy();
        redirect('/login2', 'refresh');
    }

}

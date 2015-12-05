<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of error
 *
 * @author Cristhian
 */
class dev extends CI_Controller {

    public function index() {
        $this->load->library('webservice');
        $user = $this->nativesession->get('user');
        $data['asp_id'] = $user->id_usuario;
        $data['exani'] = 2;
        echo json_encode($this->webservice->respuestasAspirante($data));
    }
    
    public function E404(){
        $this->load->view('error/404');
    }

    public function asp() {
        $this->load->library('webservice');
        echo $this->webservice->getAsp();
    }

    public function pregunta() {
        $this->load->library('webservice');
        $this->webservice->opcionesPregunta();
    }

    public function credencial() {
        $user = $this->nativesession->get('user');
        $asp = $this->nativesession->get('asp');
        $codigo = $asp->solicitudes[0]->ref_codigo;
        //echo json_encode($asp);

        $this->load->library('webservice');
        echo $this->webservice->credencial($user->id_usuario, $codigo);
    }

    public function folio() {
        $user = $this->nativesession->get('user');
        $asp = $this->nativesession->get('asp');

        $this->load->library('webservice');
        echo $this->webservice->folioUV($user->id_usuario);
    }

    function post_dev() {
        $img = 'C:/xampp/htdocs/ConvocatoriaV2/uploadsL/117.jpg';
        //$img=base_url('uploadsL/117.jpg');
        $this->load->library('webservice');
        echo $this->webservice->post_img(base_url('index.php/dev/post_dev1'), $img);
    }

    function post_dev1() {
        echo "<hr>";
        $config['upload_path'] = './uploadsL/dev';
        $config['allowed_types'] = 'jpg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload() === false) {
            $errores['error'] = $this->upload->display_errors();
            $data['errores'] = $errores;
            var_dump($data);
            //$this->load->view('capturarfoto/capturarfoto', $data);
        } else {
            $res = $this->upload->data();
            echo json_encode($res);
            echo $res['full_path'] . "<br>";
            echo "<img src='" . base_url('uploadsL/dev/') . "/" . $res['file_name'] . "'>";

            $this->load->library('webservice');
            //echo $this->webservice->confirmafoto(0, $res['full_path']);

            $this->session->set_flashdata('correcto', 'Has subido tu foto correctamente');
            //redirect('/cpanel');
        }
    }

}

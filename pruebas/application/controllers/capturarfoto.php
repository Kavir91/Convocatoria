<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class capturarfoto extends CI_Controller {

    function capturarfoto() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        $this->load->view('capturarfoto/capturarfoto');
    }

    public function confirmar() {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }

        $this->load->library('webservice');
        $res = $this->webservice->confirmafoto($user->id_usuario);
        //echo $res;
        if ($res == 'ok') {
            try {
                $this->load->model('asp/aspirante');
                $fecha = new DateTime('America/Mexico_City');
                $formato = $fecha->format("Y-m-d H:i:s");
                //echo $formato;
                $res1 = $this->aspirante->update($user->id_usuario, "subirFotografia", 0, $formato);
                $res1 = $this->aspirante->update($user->id_usuario, "imprimirCredencial", 1);
            } catch (Exception $ex) {
                
            }
            $this->session->set_flashdata('correcto', 'Has subido tu fotografía correctamente');
            redirect('/cpanel');
        } else {
            $errores['error'] = 'Ocurrió un error desconocido, por favor intenta subir tu fotografía una vez mas';
            $data['errores'] = $errores;
            $this->load->view('capturarfoto/capturarfoto', $data);
        }
    }

    function do_upload() {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        $foliouv = $this->nativesession->get('asp')->aspirante->folio;
        $config['upload_path'] = './uploadsL/';
        $config['allowed_types'] = 'jpg|jpeg|JPG|JPEG';
        $config['max_size'] = '250';
        $config['max_width'] = '480';
        $config['max_height'] = '640';
        $config['min_width'] = '480';
        $config['min_height'] = '640';
        $config['overwrite'] = true;
        //$config['file_name'] = $foliouv . '.jpg';
        $config['file_name'] = $user->id_usuario . '.jpg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload() === false) {
            $errores['userfile'] = $this->upload->display_errors();
            $data['errores'] = $errores;
            $this->load->view('capturarfoto/capturarfoto', $data);
        } else {
            $file = $this->upload->data();
            //echo json_encode($res);
            //echo $file['full_path'] . "<br>";

            $this->load->library('webservice');
            $res = $this->webservice->checarfoto($user->id_usuario, $file['full_path']);
            //var_dump($res);
            $exp = '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\.\/\?\:@\-_=#])*/';
            if ($res === "Error: <strong>La foto no parece tener una cara que se identifique bien, o haber sido tomada adecuadamente</strong>...") {
                $errores['error'] = $res;
                $data['errores'] = $errores;
                $this->load->view('capturarfoto/capturarfoto', $data);
                return;
            } else if (preg_match($exp, $res) == true) {
                $data['img_path'] = $res . "?" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                $this->load->view('capturarfoto/capturarfoto_1', $data);
                return;
            } else {
                $errores['error'] = "No se pudo cargar tu fotografía, porfavor revisa tu conexión a internet, o intenta mas tarde";
                $data['errores'] = $errores;
                $this->load->view('capturarfoto/capturarfoto', $data);
            }
        }
    }

}

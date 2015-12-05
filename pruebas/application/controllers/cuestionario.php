<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cuestionario extends CI_Controller {

    public function index_1($numeroPregunta = 0, $guardar = false) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(-1);
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }

        $this->load->model('cuestionario/preguntas');
        if ($numeroPregunta > 0) {
            $id = $this->preguntas->getNext($numeroPregunta);
            $res = $this->preguntas->find($numeroPregunta);
            if ($id['actual'] == NULL) {
                redirect('cuestionario/index_1/');
                return;
            }
            $data['preguntas'] = $res;
            $data['orden'] = $id;
        } else {
            $id = $this->preguntas->getNext(0);
            if ($id['actual'] != NULL) {
                $res = $this->preguntas->find($id['actual']);
            } else {
                $data['preguntas'] = array();
            }
            $data['orden'] = $id;
            $data['preguntas'] = $res;
        }

        if ($guardar == FALSE) {
            $this->load->view('cuestionario/cuestionario_1', $data);
        } else if ($guardar == "true" || $guardar == "TRUE") {
            if ($this->input->post() != FALSE) {
                //var_dump($this->input->post());

                $postData = $this->input->post();

                $preguntas = $postData['pregunta'];

                $this->load->library('form_validation');

                for ($i = 0; $i < count($preguntas); $i++) {
                    $this->form_validation->set_rules('respuesta' . $preguntas[$i], 'respuesta a la pregunta ' . $preguntas[$i], 'required');
                }

                if ($this->form_validation->run() === FALSE) {
                    $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
                    //echo json_encode($error_messages);
                    $id = $this->preguntas->getNext($numeroPregunta);
                    $res = $this->preguntas->find($numeroPregunta);
                    $data['preguntas'] = $res;
                    $data['orden'] = $id;
                    $this->load->view('cuestionario/cuestionario_1', $data);
                    return;
                } else {
                    $this->load->library('webservice');

                    $error = false;
                    for ($i = 0; $i < count($preguntas); $i++) {
                        $dataSend['asp_id'] = $user->id_usuario;
                        //echo "asp_id: ";
                        //$dataSend['asp_id'] = 116;
                        //echo "<br>";
                        //echo "cue_numeropregunta: ";
                        $dataSend['cue_numeropregunta'] = $preguntas[$i];
                        //echo "<br>";
                        //echo "cor_id: ";
                        $dataSend['cor_id'] = $postData['respuesta' . $preguntas[$i]];
                        //echo "<br>";
                        //echo "antes:";
                        //json_encode($dataSend);
                        $res = $this->webservice->guardarPregunta($dataSend);
                        //echo json_encode($res);
                        //echo "<hr>";
                        if ($res === NULL) {
                            $error = true;
                            $array['enviado'] = $dataSend;
                            $array['recibido'] = $res;
                            $this->session->set_flashdata('error', $array);
                            redirect('/cuestionario/index_1/' . $numeroPregunta);
                        } else
                        if ($res->estatus === "OK") {
                            $error = false;
                        } else {
                            $error = true;
                        }
                    }
                }
                if ($error === false) {
                    $id = $this->preguntas->getNext($numeroPregunta);
                    if ($id['siguiente'] == NULL) {
                        try {
                            $this->load->model('asp/aspirante');
                            $fecha = new DateTime('America/Mexico_City');
                            $formato = $fecha->format("Y-m-d H:i:s");
                            //echo $formato;
                            $res1 = $this->aspirante->update($user->id_usuario, "cuestionario", 0, $formato);
                            $res1 = $this->aspirante->update($user->id_usuario, "subirFotografia", 1);
                            $res1 = $this->aspirante->update($user->id_usuario, "imprimirPago", 1);
                        } catch (Exception $ex) {
                            
                        }

                        $this->session->set_flashdata('correcto', 'Cuestionario de contexto terminado correctamente');
                        redirect('/cpanel');
                    } else {
                        /* $res = $this->preguntas->find($id['siguiente']);
                          $data['orden'] = $id;
                          $data['preguntas'] = $res;
                          $this->load->view('cuestionario/cuestionario_1', $data);
                         */
                        $array['enviado'] = $dataSend;
                        $array['recibido'] = $res;
                        $this->session->set_flashdata('correcto', $array);
                        redirect('/cuestionario/index_1/' . $id['siguiente']);
                    }
                } else {
                    $id = $this->preguntas->getNext($numeroPregunta);
                    $res = $this->preguntas->find($numeroPregunta);
                    $data['preguntas'] = $res;
                    $data['orden'] = $id;
                    $errores['Error'] = 'Error al guardar la pregunta, porfavor intente nuevamente, o regrese mas tarde';
                    $data['errores'] = $errores;
                    $this->load->view('cuestionario/cuestionario_1', $data);
                }
            } else {//no hubo post
                redirect('/cuestionario/index_1/' . $numeroPregunta);
            }
        } else {//guardar != true
            redirect('/cuestionario/index_1/' . $numeroPregunta);
        }
    }

    public function index($guardar = false) {
        redirect('/cuestionario/index_1');
        return;
//        $user = $this->nativesession->get('user');
//        if ($user == NULL) {
//            redirect('/login2');
//            return;
//        }
//
//        if ($guardar == FALSE) {
//            $this->load->model('Cuestionario/Preguntas');
//            $res = $this->Preguntas->all();
//            $data['preguntas'] = $res;
//            $this->load->view('cuestionario/cuestionario', $data);
//        } else if ($guardar == "true" || $guardar == "TRUE") {
//            if ($this->input->post() != FALSE) {
//                //var_dump($this->input->post());
//
//                $postData = $this->input->post();
//
//                $preguntas = $postData['pregunta'];
//
//                $this->load->library('form_validation');
//
//                for ($i = 0; $i < count($preguntas); $i++) {
//                    $this->form_validation->set_rules('respuesta' . $preguntas[$i], 'respuesta a la pregunta ' . $preguntas[$i], 'required');
//                }
//
//                if ($this->form_validation->run() === FALSE) {
//                    $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
//                    //echo json_encode($error_messages);
//                    $this->load->model('Cuestionario/Preguntas');
//                    $res = $this->Preguntas->all();
//                    $data['preguntas'] = $res;
//                    $this->load->view('cuestionario/cuestionario', $data);
//                } else {
//                    $this->load->library('webservice');
//                    //var_dump($this->input->post());
//                    //$dataSend['asp_id'] = $user->id_usuario;
//                    //$dataSend['cue_numeropregunta'] = $preguntas[0];
//                    //$dataSend['cor_id'] = 50;
//                    //echo "<hr> pregunta: " . $preguntas[$i] . ", respuesta: " . $respuestas[$i] . "<br>";
//                    //echo $res = $this->webservice->guardarPregunta($dataSend);
//                    $error = false;
//                    for ($i = 0; $i < count($preguntas); $i++) {
//                        $dataSend['asp_id'] = $user->id_usuario;
//                        //echo "asp_id: ";
//                        //$dataSend['asp_id'] = 116;
//                        //echo "<br>";
//                        //echo "cue_numeropregunta: ";
//                        $dataSend['cue_numeropregunta'] = $preguntas[$i];
//                        //echo "<br>";
//                        //echo "cor_id: ";
//                        $dataSend['cor_id'] = $postData['respuesta' . $preguntas[$i]];
//                        //echo "<br>";
//                        //echo "antes:";
//                        //json_encode($dataSend);
//                        $res = $this->webservice->guardarPregunta($dataSend);
//                        //echo json_encode($res);
//                        //echo "<hr>";
//                        if ($error === NULL) {
//                            $error = true;
//                        } else
//                        if ($res->estatus === "OK") {
//                            $error = false;
//                        } else {
//                            $error = true;
//                        }
//                    }
//                }
//                if ($error === false) {
//                    $this->session->set_flashdata('correcto', 'Cuestionario de contexto correctamente');
//                    redirect('/cpanel');
//                } else {
//                    $errores['Error'] = 'Error al guardar las preguntas, porfavor intente nuevamente, o regrese mas tarde';
//                    $data['errores'] = $errores;
//                    $this->load->view('cuestionario/cuestionario', $data);
//                }
//            } else {//no hubo post
//                redirect('/cuestionario/');
//            }
//        } else {//guardar != true
//            redirect('/cuestionario/');
//        }
    }

}

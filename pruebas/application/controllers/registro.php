<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class registro extends CI_Controller {

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
//        redirect('/login2');
        $curp = $this->input->post('curp');
        $data['curp'] = '';
        $data['extr'] = false;
        if ($curp != false) {
            $data['curp'] = $curp;
            $this->load->library('webservice');
            $data['asp_curp'] = $curp;
            $resp = $this->webservice->valRegistroExistente($data);
            if ($resp->estatus != 'OK') {
//                echo json_encode($resp);
                $this->load->view('registro/registroInicial_2', $data);
                return;
            }
        }

        $extr = $this->input->post('extranjero');
        if ($extr != false) {
            $data['extr'] = true;
        }

        $this->load->view('registro/registroInicial', $data);
    }

    public function index2() {
        $this->load->view('registro/registro_dev');
    }

    public function save() {
        /* $this->input->post();
          echo implode($this->input->post()); */
        $this->load->library('form_validation');

        $this->form_validation->set_rules('asp_nombres', 'Nombre', 'required|alpha|min_length[4]');
        $this->form_validation->set_rules('asp_apellidopaterno', 'Apellido paterno', 'required|alpha|min_length[4]');
        $this->form_validation->set_rules('asp_apellidomaterno', 'Apellido materno', 'alpha|min_length[4]');
        $this->form_validation->set_rules('dianacimiento', 'Día de nacimiento', 'min_length[2]');
        $this->form_validation->set_rules('mesnacimiento', 'Mes de nacimiento', 'min_length[2]');
        $this->form_validation->set_rules('anionacimiento', 'Año de nacimiento', 'required|numeric|exact_length[4]');

        $this->form_validation->set_rules('asp_nacionalidad', 'Nacionalidad', 'min_length[1]');
        $this->form_validation->set_rules('asp_paisnacimiento', 'País de nacimiento', 'max_length[4]');
        $this->form_validation->set_rules('asp_estadonacimiento', 'Estado de nacimiento', 'max_length[4]');
        $this->form_validation->set_rules('asp_municipionacimiento', 'Municipio de nacimiento', 'required|max_length[4]|greater_than[1]');
        $this->form_validation->set_rules('asp_sexo', 'Sexo', 'max_length[1]');
        $this->form_validation->set_rules('asp_estadocivil', 'Estado civil', 'max_length[1]');
        $this->form_validation->set_rules('asp_idpreguntadeseguridad', 'Pregunta secreta', 'max_length[2]');
        $this->form_validation->set_rules('asp_carrera', 'Carrera', 'max_length[4]');
        $this->form_validation->set_rules('asp_familiarizadoconbraile', '¿Estas familiarizado con el sistema braile?', 'alpha|max_length[1]');

        if ($this->input->post('asp_nacionalidad') != "E") {
            $this->form_validation->set_rules('asp_curp', 'Curp', 'required|alpha_numeric|exact_length[18]');
        }
        $this->form_validation->set_rules('asp_lada', ' Clave lada', 'required|numeric|exact_length[3]');
        $this->form_validation->set_rules('asp_telefono', 'Número de teléfono', 'required|numeric|exact_length[7]');
        $this->form_validation->set_rules('asp_celular', 'Numero de celular', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('asp_ladaconfirma', 'confirmación de clave lada', 'required|matches[asp_lada]');
        $this->form_validation->set_rules('asp_telefonoconfirma', 'confirmación de teléfono', 'required|numeric|exact_length[7]|matches[asp_telefono]');
        $this->form_validation->set_rules('asp_celularconfirma', 'confirmación de celular', 'required|numeric|exact_length[10]|matches[asp_celular]');
        $this->form_validation->set_rules('asp_email', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('asp_password', 'contraseña', 'required');
        $this->form_validation->set_rules('asp_emailconfirma', 'confirmación de correo electrónico', 'required|valid_email|matches[asp_email]');
        $this->form_validation->set_rules('asp_repassword', 'confirmación de contraseña', 'required|matches[asp_password]');
        $this->form_validation->set_rules('asp_respuestapreguntaseguridad', 'respuesta a la pregunta secreta', 'required|max_length[30]');
        $this->form_validation->set_rules('asp_carrera', 'carrera', 'required|greater_than[1]');
        $this->form_validation->set_rules('car_campus', 'campus', 'required');
        $this->form_validation->set_rules('car_modalidad', 'modalidad', 'required');

        if ($this->form_validation->run() === FALSE) {
//$this->session->set_flashdata('errores', $error_messages = $this->form_validation->getValidationErrorAsArray());
            $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
//echo json_encode($data['errores']);
            $this->load->view('registro/registroInicial', $data);
        } else {
            $postData = $this->input->post();
            $postData["asp_fechanacimiento"] = urlencode($postData['anionacimiento'] . "-" . $postData['mesnacimiento'] . "-" . $postData['dianacimiento']);
            $postData["asp_fecharegistro"] = urlencode(date('Y') . "-" . date('n') . "-" . date('d'));

            unset($postData['car_campus']);
            unset($postData['car_modalidad']);

            $this->load->library('webservice');
            $data = $this->webservice->guardaregistroinicial($postData);


            $postData_1["foliouv"] = $data->datosUsuario->folio;
            $postData_1["contrasena"] = $postData["asp_password"];

            $user = $this->webservice->checklogin($postData_1);

            $rec['id_usuario'] = $user->id_usuario;

            $asp = $this->webservice->recuperarRegistro($rec);

            $this->nativesession->set('user', $user);
            $this->nativesession->set('asp', $asp);

            $dataSend['resultado'] = $data;
            $this->load->view('registro/registroInicial_1', $dataSend);
        }
    }

    public function datosEscolares($guardar = false) {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        if ($guardar == FALSE) {
            //solo mostrar la vista
            $this->load->view('registro/datosEscolares');
        } else if ($guardar == "true" || $guardar == "TRUE") {
            //guardar y mostrar la vista
            if ($this->input->post() != FALSE) {

                $postdata = $this->input->post();

                $this->load->library('form_validation');
                $datosEscuela = array();
                switch ($this->input->post('asp_gradoescuela')) {
                    case "P": {//primaria
                            $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
                            $datosEscuela['asp_gradoescuela'] = $this->input->post('asp_gradoescuela');
                            break;
                        }
                    case "S": {//secundaria
                            $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
                            $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|greater_than[1]|max_length[4]');
                            $datosEscuela['asp_gradoescuela'] = $this->input->post('asp_gradoescuela');
                            $datosEscuela['asp_promediosecundaria'] = $this->input->post('asp_promediosecundaria');
                            break;
                        }
                    case "B": {//bachillerato concluido
                            $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
                            $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|greater_than[1]|max_length[4]');
                            $this->form_validation->set_rules('asp_promediobach', 'Promedio del bachillerato', 'required|greater_than[1]|max_length[4]');
                            $this->form_validation->set_rules('asp_nopresentoexani1', '¿Presentastes EXANI I?', 'numeric|exact_length[1]');
                            if ($this->input->post('asp_nopresentoexani1') === "0") {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'numeric|max_length[4]');
                            } else if ($this->input->post('asp_nopresentoexani1') === "1") {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'required|numeric|max_length[4]');
                            } else {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'required|numeric|max_length[4]');
                            }
                            $this->form_validation->set_rules('asp_anioingresoselect', 'Año en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_mesegresoselect', 'Mes en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_anioegresoselect', 'Año en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_areabachillerato', 'Area del bachillerato', 'required|numeric|max_length[4]');

                            $this->form_validation->set_rules('asp_estudioenmexico', 'estudio en México', 'required|alpha|max_length[4]');
                            $this->form_validation->set_rules('asp_paisestudios', 'país de estudios', 'numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_estudioenveracruz', 'estudio en Veracruz', 'alpha|max_length[4]');
                            $this->form_validation->set_rules('asp_estadoestudios', 'estado donde estudiaste', 'numeric|max_length[4]');

                            $this->form_validation->set_rules('listamunicipios', 'Municipio de procedencia', 'required|numeric|greater_than[1]');
                            $this->form_validation->set_rules('listasector', 'sector de la escuela', 'required|alpha');
                            $this->form_validation->set_rules('listaturnos', 'turno de la escuela', 'required|alpha');
                            $this->form_validation->set_rules('asp_escueladeprocedencia', 'escuela de procedencia', 'required|numeric|max_length[4]');

                            $datosEscuela['id_usuario'] = $user->id_usuario;
                            $datosEscuela['pruebaid_escuela'] = $postdata['asp_escueladeprocedencia'];
                            $datosEscuela['asp_anioingresoselect'] = $postdata['asp_anioingresoselect'];
                            $datosEscuela['asp_mesegresoselect'] = $postdata['asp_mesegresoselect'];
                            $datosEscuela['asp_anioegresoselect'] = $postdata['asp_anioegresoselect'];
                            $datosEscuela['asp_areabachillerato'] = $postdata['asp_areabachillerato'];
                            $datosEscuela['asp_gradoescuela'] = $postdata['asp_gradoescuela'];
                            if ($postdata['asp_estudioenmexico'] == 'S') {
                                $datosEscuela['pruebaid_paisestudios'] = 99;
                                if ($postdata['asp_estudioenveracruz'] == "S") {//asp_estudioenveracruz
                                    $datosEscuela['pruebaid_estadoestudios'] = 1;
                                } else {
                                    $datosEscuela['pruebaid_estadoestudios'] = $this->input->post('asp_estadoestudios');
                                }
                            } else {
                                $datosEscuela['pruebaid_paisestudios'] = $postdata['asp_paisestudios']; //
                            }
                            $datosEscuela['asp_promediosecundaria'] = $postdata['asp_promediosecundaria'];
                            $datosEscuela['asp_promediobach'] = $postdata['asp_promediobach'];
                            $datosEscuela['asp_nopresentoexani1'] = $postdata['asp_nopresentoexani1'];
                            $datosEscuela['asp_aniopresentoexani1'] = $postdata['asp_aniopresentoexani1'];
                            break;
                        }
                    case "I": {//bachillerato inscrito
                            $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
                            $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|greater_than[1]|max_length[4]');
//                            $this->form_validation->set_rules('asp_promediobach', 'Promedio del bachillerato', 'greater_than[1]|decimal|max_length[4]');
                            $this->form_validation->set_rules('asp_nopresentoexani1', '¿Presentastes EXANI I?', 'numeric|exact_length[1]');
                            if ($this->input->post('asp_nopresentoexani1') === "0") {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'numeric|max_length[4]');
                            } else if ($this->input->post('asp_nopresentoexani1') === "1") {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'required|numeric|max_length[4]');
                            } else {
                                $this->form_validation->set_rules('asp_aniopresentoexani1', 'Año de presentación de EXANI I', 'required|numeric|max_length[4]');
                            }
                            $this->form_validation->set_rules('asp_anioingresoselect', 'Año en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_mesegresoselect', 'Mes en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_anioegresoselect', 'Año en el que ingresaste al bachillerato', 'required|numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_areabachillerato', 'Area del bachillerato', 'required|numeric|max_length[4]');

                            $this->form_validation->set_rules('asp_estudioenmexico', 'estudio en México', 'required|alpha|max_length[4]');
                            $this->form_validation->set_rules('asp_paisestudios', 'país de estudios', 'numeric|max_length[4]');
                            $this->form_validation->set_rules('asp_estudioenveracruz', 'estudio en Veracruz', 'alpha|max_length[4]');
                            $this->form_validation->set_rules('asp_estadoestudios', 'estado donde estudiaste', 'numeric|max_length[4]');


                            $this->form_validation->set_rules('listamunicipios', 'Municipio de procedencia', 'required|numeric|greater_than[1]');
                            $this->form_validation->set_rules('listasector', 'sector de la escuela', 'required|alpha');
                            $this->form_validation->set_rules('listaturnos', 'turno de la escuela', 'required|alpha');
                            $this->form_validation->set_rules('asp_escueladeprocedencia', 'escuela de procedencia', 'required|numeric|max_length[4]');

                            $datosEscuela['id_usuario'] = $user->id_usuario;
                            $datosEscuela['pruebaid_escuela'] = $postdata['asp_escueladeprocedencia'];
                            $datosEscuela['asp_anioingresoselect'] = $postdata['asp_anioingresoselect'];
                            $datosEscuela['asp_mesegresoselect'] = $postdata['asp_mesegresoselect'];
                            $datosEscuela['asp_anioegresoselect'] = $postdata['asp_anioegresoselect'];
                            $datosEscuela['asp_areabachillerato'] = $postdata['asp_areabachillerato'];
                            $datosEscuela['asp_gradoescuela'] = $postdata['asp_gradoescuela'];
                            if ($postdata['asp_estudioenmexico'] == 'S') {
                                $datosEscuela['pruebaid_paisestudios'] = 99;
                                if ($postdata['asp_estudioenveracruz'] == "S") {//asp_estudioenveracruz
                                    $datosEscuela['pruebaid_estadoestudios'] = 1;
                                } else {
                                    $datosEscuela['pruebaid_estadoestudios'] = $this->input->post('asp_estadoestudios');
                                }
                            } else {
                                $datosEscuela['pruebaid_paisestudios'] = $postdata['asp_paisestudios']; //
                            }
                            $datosEscuela['asp_promediosecundaria'] = $postdata['asp_promediosecundaria'];
//                            $datosEscuela['asp_promediobach'] = $postdata['asp_promediobach'];
                            $datosEscuela['asp_nopresentoexani1'] = $postdata['asp_nopresentoexani1'];
                            if ($postdata['asp_nopresentoexani1'] === "1") {
                                $datosEscuela['asp_aniopresentoexani1'] = $postdata['asp_aniopresentoexani1'];
                            }
                            break;
                        }
                }//fin switch

                if ($this->form_validation->run() == FALSE) {
                    //echo "errores";
                    $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
                    //echo json_encode($data['errores']);
                    $this->load->view('registro/datosEscolares', $data);
                } else {
                    $this->load->library('webservice');
                    $res = $this->webservice->guardadatosescuela($datosEscuela);
                    if ($res->estatus == "OK") {
                        $this->session->set_flashdata('correcto', 'Datos escolares actualizados correctamente');
                        redirect('/cpanel');
                    } else {
                        $error_messages['error'] = "Error al guardar, vuelva a intentarlo mas tarde";
                        $data['errores'] = $error_messages;
                        $this->load->view('registro/datosEscolares', $data);
                    }
                }
                //redirect('/registro/datosEscolares');
            } else {
                redirect('/registro/datosEscolares');
            }
        } else {
            $this->load->view('registro/datosEscolares');
        }
    }

    public function datosPersonales($guardar = false) {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        if ($guardar == FALSE) {
            $this->load->view('registro/datosPersonales');
        } else if ($guardar == "true" || $guardar == "TRUE") {
            if ($this->input->post() != FALSE) {
                $postdata = $this->input->post();
                $this->load->library('form_validation');

                $this->form_validation->set_rules('asp_paisdomicilio', 'país donde vives', 'required|numeric|max_length[4]');
                $this->form_validation->set_rules('asp_estadodomicilio', 'estado donde vives', 'numeric|max_length[4]');
                $this->form_validation->set_rules('asp_municipiodomicilio', 'municipio donde vives', 'numeric|max_length[4]');
                $this->form_validation->set_rules('asp_localidaddomicilio', 'localidad donde vives', 'required|numeric|min_length[1]|max_length[20]');
                $this->form_validation->set_rules('asp_domicilio', 'domicilio donde vives', 'required|alpha|max_length[100]');
                $this->form_validation->set_rules('asp_coloniadomicilio', 'colonia donde vives', 'numeric|max_length[6]');
                $this->form_validation->set_rules('asp_codigopostal', 'código postal', 'required|numeric|exact_length[5]');

                $this->form_validation->set_rules('asp_seguromedico', '¿tienes derecho a servicios médicos?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_religion', '¿cuál es tu religión', 'required|numeric|max_length[4]');
                $this->form_validation->set_rules('asp_lenguaindigena1', '¿hablas una lengua indígena?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_lenguaindigena2', '¿te consideras indígena?', 'required|numeric|max_length[2]');

                $this->form_validation->set_rules('asp_discapacidad1', 'tienes problemas para caminar, moverte, subir o bajar', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad2', 'tienes problemas para ver aún usando lentes', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad3', 'tienes problemas para hablar, comunicarte o conversar', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad4', 'tienes problemas para oír aún usando aparato auditivo', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad5', 'tienes problemas para vestirte, bañarte o comer', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad6', 'tienes problemas para poner atención, o aprender cosas sencillas', 'required|alpha|max_length[2]');
                $this->form_validation->set_rules('asp_discapacidad7', '¿Tienes alguna limitación mental?', 'required|alpha|max_length[2]');

                $this->form_validation->set_rules('asp_motivo_1', '¿por qué tienes limitaciones para caminar, moverte, subir o bajar?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_2', '¿por qué tienes limitaciones para ver aún usando lentes?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_3', '¿por qué tienes limitaciones para hablar, comunicarte o conversar?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_4', '¿por qué tienes limitaciones para oír aún usando aparato auditivo?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_5', '¿por qué tienes limitaciones para vestirte, bañarte o comer?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_6', '¿por qué tienes limitaciones para poner atención, o aprender cosas sencillas?', 'required|numeric|max_length[2]');
                $this->form_validation->set_rules('asp_motivo_7', '¿por qué tienes una limitación mental?', 'required|numeric|max_length[2]');

                $this->form_validation->set_rules('asp_nombretutor', 'nombre de la persona para emergencias', 'required|alpha|min_length[4]|max_length[50]');
                $this->form_validation->set_rules('asp_primerapellidotutor', 'apellido paterno de la personas para emergencias', 'required|alpha|min_length[4]|max_length[50]');
                $this->form_validation->set_rules('asp_segundoapellidotutor', 'apellido materno', 'alpha|min_length[4]|max_length[50]');
                $this->form_validation->set_rules('asp_parentesco', 'parentesco de la persona para emergencias', 'required|numeric|max_length[1]');
                $this->form_validation->set_rules('asp_emailtutor', 'correo electrónico de la persona para emergencias', 'required|valid_email|max_length[50]');
                $this->form_validation->set_rules('asp_emailtutorconfirma', 'confirmación de correo electrónico de la persona para emergencias', 'required|valid_email|max_length[50]|matches[asp_emailtutor]');
                $this->form_validation->set_rules('asp_ladatutor', 'lada de la persona para emergencias', 'required|numeric|max_length[3]');
                $this->form_validation->set_rules('asp_telefonotutor', 'teléfono de la persona para emergencias', 'required|numeric|max_length[7]');
                $this->form_validation->set_rules('asp_ladatutorconfirma', 'confirmación de lada de la persona para emergencias', 'required|numeric|max_length[3]|matches[asp_ladatutor]');
                $this->form_validation->set_rules('asp_telefonotutorconfirma', 'confirmación de teléfono de la persona para emergencias', 'required|numeric|max_length[7]|matches[asp_telefonotutor]');
                $this->form_validation->set_rules('asp_celulartutor', 'número de celular de la persona para emergencias', 'required|numeric|max_length[10]');
                $this->form_validation->set_rules('asp_celulartutorconfirma', 'confirmación del número de celular de la persona para emergencias', 'required|numeric|max_length[10]|matches[asp_celulartutor]');

                if ($this->form_validation->run() == FALSE) {
                    //errores de validación
                    $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
                    //echo json_encode($data['errores']);
                    $this->load->view('registro/datosPersonales', $data);
                } else {
                    //no hay errores
                    $this->load->library('webservice');

                    $datos['id_usuario'] = $user->id_usuario; //$postdata

                    $datos['asp_paisdomicilio'] = $postdata['asp_paisdomicilio'];
                    $datos['asp_estadodomicilio'] = $postdata['asp_estadodomicilio'];
                    $datos['asp_municipiodomicilio'] = $postdata['asp_municipiodomicilio'];
                    $datos['asp_idmunicipiodomicilio'] = $postdata['asp_municipiodomicilio'];
                    $datos['asp_localidaddomicilio'] = $postdata['asp_localidaddomicilio'];
                    $datos['asp_domicilio'] = $postdata['asp_domicilio'];
                    $datos['asp_colonia'] = $postdata['asp_coloniadomicilio'];
                    $datos['asp_codigopostal'] = $postdata['asp_codigopostal'];

                    $datos['asp_seguromedico'] = $postdata['asp_seguromedico'];
                    $datos['asp_religion'] = $postdata['asp_religion'];
                    $datos['asp_lenguaindigena1'] = $postdata['asp_lenguaindigena1'];
                    $datos['asp_lenguaindigena2'] = $postdata['asp_lenguaindigena2'];

                    $datos['asp_discapacidad1'] = $postdata['asp_discapacidad1'];
                    $datos['asp_discapacidad2'] = $postdata['asp_discapacidad2'];
                    $datos['asp_discapacidad3'] = $postdata['asp_discapacidad3'];
                    $datos['asp_discapacidad4'] = $postdata['asp_discapacidad4'];
                    $datos['asp_discapacidad5'] = $postdata['asp_discapacidad5'];
                    $datos['asp_discapacidad6'] = $postdata['asp_discapacidad6'];
                    $datos['asp_discapacidad7'] = $postdata['asp_discapacidad7'];
                    $datos['asp_motivo1'] = $postdata['asp_motivo_1'];
                    $datos['asp_motivo2'] = $postdata['asp_motivo_2'];
                    $datos['asp_motivo3'] = $postdata['asp_motivo_3'];
                    $datos['asp_motivo4'] = $postdata['asp_motivo_4'];
                    $datos['asp_motivo5'] = $postdata['asp_motivo_5'];
                    $datos['asp_motivo6'] = $postdata['asp_motivo_6'];
                    $datos['asp_motivo7'] = $postdata['asp_motivo_7'];

                    $datos['asp_nombretutor'] = $postdata['asp_nombretutor'];
                    $datos['asp_primerapellidotutor'] = $postdata['asp_primerapellidotutor'];
                    $datos['asp_segundoapellidotutor'] = $postdata['asp_segundoapellidotutor'];
                    $datos['asp_emailtutor'] = $postdata['asp_emailtutor'];
                    $datos['asp_ladatutor'] = $postdata['asp_ladatutor'];
                    $datos['asp_telefonotutor'] = $postdata['asp_telefonotutor'];
                    $datos['asp_celulartutor'] = $postdata['asp_celulartutor'];
                    $datos['asp_parentesco'] = $postdata['asp_parentesco'];
                    $datos['asp_emailtutorconfirma'] = $postdata['asp_emailtutorconfirma'];
                    $datos['asp_ladatutorconfirma'] = $postdata['asp_ladatutorconfirma'];
                    $datos['asp_telefonotutorconfirma'] = $postdata['asp_telefonotutorconfirma'];
                    $datos['asp_celulartutorconfirma'] = $postdata['asp_celulartutorconfirma'];

                    $datos['asp_numeroserviciomedico'] = 0000;
                    $datos['asp_regionexamen'] = 0000;

                    $res = $this->webservice->guardadatosparticulares($datos);
                    if ($res->estatus == "OK") {
                        $this->session->set_flashdata('correcto', 'Datos personales actualizados correctamente');
                        redirect('/cpanel');
                    } else {
                        $error_messages['error'] = "Error al guardar, vuelva a intentarlo mas tarde";
                        $data['errores'] = $error_messages;
                        $this->load->view('registro/datosPersonales', $data);
                    }
                }
            } else {
                redirect('/registro/datosPersonales');
            }
        } else {
            $this->load->view('registro/datosPersonales');
        }
    }

    public function datosFamiliares($guardar = false) {
        $user = $this->nativesession->get('user');
        if ($user == NULL) {
            redirect('/login2');
            return;
        }
        if ($guardar == FALSE) {
            $this->load->view('registro/datosFamiliares');
        } else if (strtoupper($guardar) == "TRUE") {
            if ($this->input->post() != FALSE) {
                $this->load->library('form_validation');
                $postdata = $this->input->post();

                $this->form_validation->set_rules('asp_mismodom', '¿El domicilio donde vive tu familia es el mismo en que vivirás mientras estudias?', 'required|alpha|exact_length[1]');
                $this->form_validation->set_rules('asp_cuantoscontribuyen', '¿Cuántos contribuyen al ingreso familiar? ', 'required|integer|exact_length[1]|greater_than[0]|less_than[6]');

                if ($postdata['dependpadre'] != NULL) {
                    $this->form_validation->set_rules('dependpadre', '¿Dependes de tu padre?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependmadre'] != NULL) {
                    $this->form_validation->set_rules('dependmadre', '¿Dependes de tu madre?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependhermano'] != NULL) {
                    $this->form_validation->set_rules('dependhermano', '¿Dependes de algún hermano?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependfamiliares'] != NULL) {
                    $this->form_validation->set_rules('dependfamiliares', '¿Dependes de tus familiares?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependbeca'] != NULL) {
                    $this->form_validation->set_rules('dependbeca', '¿Dependes de alguna beca?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependyo'] != NULL) {
                    $this->form_validation->set_rules('dependyo', '¿Dependes de ti mismo?', 'required|alpha|exact_length[1]');
                }
                if ($postdata['dependotros'] != NULL) {
                    $this->form_validation->set_rules('dependotros', '¿Dependes de otros?', 'required|alpha|exact_length[1]');
                    $this->form_validation->set_rules('dependotros', '¿De quién mas dependes?', 'alpha|max_length[30]');
                }


                switch ($postdata['asp_cuantoscontribuyen']) {
                    case '1': {
                            for ($i = 0; $i < 1; $i++) {
                                $this->form_validation->set_rules('nombre_' . ($i + 1), 'Nombre del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('appaterno_' . ($i + 1), 'Apellido paterno del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('apmaterno_' . ($i + 1), 'Apellido materno del contribuyente número ' . ($i + 1), 'alpha|max_length[50]');
                                $this->form_validation->set_rules('sexo_' . ($i + 1), 'Sexo del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('edad_' . ($i + 1), 'Edad del contribuyente número ' . ($i + 1), 'required|integer|max_length[3] ');
                                $this->form_validation->set_rules('parentesco_' . ($i + 1), 'Parentesco del contribuyente número ' . ($i + 1), 'required|alpha|max_length[6]');
                                $this->form_validation->set_rules('ultimogrado_' . ($i + 1), '¿Cuál fué el último grado que aprobó en la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]');
                                $this->form_validation->set_rules('asisteescuela_' . ($i + 1), '¿Asiste actualmente a estudiar a la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                $this->form_validation->set_rules('quehace_' . ($i + 1), '¿Qué hace en su trabajo? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('ocupacion_' . ($i + 1), '¿Cuál es el nombre de la ocupación, oficio o puesto? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('entrabajoes_' . ($i + 1), 'En su trabajo es,  del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]'); ////**checar cadena de error
                                $this->form_validation->set_rules('ingreso_' . ($i + 1), 'ingreso del contribuyente número ' . ($i + 1), 'required|numeric|max_length[6]');

                                $cad = 'recibegob_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibegob_' . ($i + 1), '¿Recibe dinero por programas de gobierno? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibejub_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibejub_' . ($i + 1), '¿Recibe dinero por jubilación o pensión? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotropais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotropais_' . ($i + 1), '¿Recibe ayuda de personas que viven en otro país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeestepais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeestepais_' . ($i + 1), '¿Recibe ayuda de personas que viven en este país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotras_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotras_' . ($i + 1), '¿Recibe ayuda de otras fuentes? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                            }
                            break;
                        }
                    case '2': {
                            for ($i = 0; $i < 2; $i++) {
                                $this->form_validation->set_rules('nombre_' . ($i + 1), 'Nombre del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('appaterno_' . ($i + 1), 'Apellido paterno del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('apmaterno_' . ($i + 1), 'Apellido materno del contribuyente número ' . ($i + 1), 'alpha|max_length[50]');
                                $this->form_validation->set_rules('sexo_' . ($i + 1), 'Sexo del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('edad_' . ($i + 1), 'Edad del contribuyente número ' . ($i + 1), 'required|integer|max_length[3] ');
                                $this->form_validation->set_rules('parentesco_' . ($i + 1), 'Parentesco del contribuyente número ' . ($i + 1), 'required|alpha|max_length[6]');
                                $this->form_validation->set_rules('ultimogrado_' . ($i + 1), '¿Cuál fué el último grado que aprobó en la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]');
                                $this->form_validation->set_rules('asisteescuela_' . ($i + 1), '¿Asiste actualmente a estudiar a la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                $this->form_validation->set_rules('quehace_' . ($i + 1), '¿Qué hace en su trabajo? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('ocupacion_' . ($i + 1), '¿Cuál es el nombre de la ocupación, oficio o puesto? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('entrabajoes_' . ($i + 1), 'En su trabajo es,  del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]'); ////**checar cadena de error
                                $this->form_validation->set_rules('ingreso_' . ($i + 1), 'ingreso del contribuyente número ' . ($i + 1), 'required|numeric|max_length[6]');

                                $cad = 'recibegob_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibegob_' . ($i + 1), '¿Recibe dinero por programas de gobierno? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibejub_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibejub_' . ($i + 1), '¿Recibe dinero por jubilación o pensión? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotropais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotropais_' . ($i + 1), '¿Recibe ayuda de personas que viven en otro país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeestepais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeestepais_' . ($i + 1), '¿Recibe ayuda de personas que viven en este país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotras_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotras_' . ($i + 1), '¿Recibe ayuda de otras fuentes? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                            }
                            break;
                        }
                    case '3': {
                            for ($i = 0; $i < 3; $i++) {
                                $this->form_validation->set_rules('nombre_' . ($i + 1), 'Nombre del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('appaterno_' . ($i + 1), 'Apellido paterno del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('apmaterno_' . ($i + 1), 'Apellido materno del contribuyente número ' . ($i + 1), 'alpha|max_length[50]');
                                $this->form_validation->set_rules('sexo_' . ($i + 1), 'Sexo del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('edad_' . ($i + 1), 'Edad del contribuyente número ' . ($i + 1), 'required|integer|max_length[3] ');
                                $this->form_validation->set_rules('parentesco_' . ($i + 1), 'Parentesco del contribuyente número ' . ($i + 1), 'required|alpha|max_length[6]');
                                $this->form_validation->set_rules('ultimogrado_' . ($i + 1), '¿Cuál fué el último grado que aprobó en la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]');
                                $this->form_validation->set_rules('asisteescuela_' . ($i + 1), '¿Asiste actualmente a estudiar a la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                $this->form_validation->set_rules('quehace_' . ($i + 1), '¿Qué hace en su trabajo? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('ocupacion_' . ($i + 1), '¿Cuál es el nombre de la ocupación, oficio o puesto? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('entrabajoes_' . ($i + 1), 'En su trabajo es,  del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]'); ////**checar cadena de error
                                $this->form_validation->set_rules('ingreso_' . ($i + 1), 'ingreso del contribuyente número ' . ($i + 1), 'required|numeric|max_length[6]');

                                $cad = 'recibegob_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibegob_' . ($i + 1), '¿Recibe dinero por programas de gobierno? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibejub_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibejub_' . ($i + 1), '¿Recibe dinero por jubilación o pensión? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotropais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotropais_' . ($i + 1), '¿Recibe ayuda de personas que viven en otro país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeestepais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeestepais_' . ($i + 1), '¿Recibe ayuda de personas que viven en este país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotras_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotras_' . ($i + 1), '¿Recibe ayuda de otras fuentes? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                            }
                            break;
                        }
                    case '4': {
                            for ($i = 0; $i < 4; $i++) {
                                $this->form_validation->set_rules('nombre_' . ($i + 1), 'Nombre del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('appaterno_' . ($i + 1), 'Apellido paterno del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('apmaterno_' . ($i + 1), 'Apellido materno del contribuyente número ' . ($i + 1), 'alpha|max_length[50]');
                                $this->form_validation->set_rules('sexo_' . ($i + 1), 'Sexo del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('edad_' . ($i + 1), 'Edad del contribuyente número ' . ($i + 1), 'required|integer|max_length[3] ');
                                $this->form_validation->set_rules('parentesco_' . ($i + 1), 'Parentesco del contribuyente número ' . ($i + 1), 'required|alpha|max_length[6]');
                                $this->form_validation->set_rules('ultimogrado_' . ($i + 1), '¿Cuál fué el último grado que aprobó en la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]');
                                $this->form_validation->set_rules('asisteescuela_' . ($i + 1), '¿Asiste actualmente a estudiar a la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                $this->form_validation->set_rules('quehace_' . ($i + 1), '¿Qué hace en su trabajo? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('ocupacion_' . ($i + 1), '¿Cuál es el nombre de la ocupación, oficio o puesto? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('entrabajoes_' . ($i + 1), 'En su trabajo es,  del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]'); ////**checar cadena de error
                                $this->form_validation->set_rules('ingreso_' . ($i + 1), 'ingreso del contribuyente número ' . ($i + 1), 'required|numeric|max_length[6]');

                                $cad = 'recibegob_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibegob_' . ($i + 1), '¿Recibe dinero por programas de gobierno? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibejub_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibejub_' . ($i + 1), '¿Recibe dinero por jubilación o pensión? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotropais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotropais_' . ($i + 1), '¿Recibe ayuda de personas que viven en otro país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeestepais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeestepais_' . ($i + 1), '¿Recibe ayuda de personas que viven en este país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotras_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotras_' . ($i + 1), '¿Recibe ayuda de otras fuentes? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                            }
                            break;
                        }
                    case '5': {
                            for ($i = 0; $i < 5; $i++) {
                                $this->form_validation->set_rules('nombre_' . ($i + 1), 'Nombre del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('appaterno_' . ($i + 1), 'Apellido paterno del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('apmaterno_' . ($i + 1), 'Apellido materno del contribuyente número ' . ($i + 1), 'alpha|max_length[50]');
                                $this->form_validation->set_rules('sexo_' . ($i + 1), 'Sexo del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('edad_' . ($i + 1), 'Edad del contribuyente número ' . ($i + 1), 'required|integer|max_length[3] ');
                                $this->form_validation->set_rules('parentesco_' . ($i + 1), 'Parentesco del contribuyente número ' . ($i + 1), 'required|alpha|max_length[6]');
                                $this->form_validation->set_rules('ultimogrado_' . ($i + 1), '¿Cuál fué el último grado que aprobó en la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]');
                                $this->form_validation->set_rules('asisteescuela_' . ($i + 1), '¿Asiste actualmente a estudiar a la escuela? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                $this->form_validation->set_rules('quehace_' . ($i + 1), '¿Qué hace en su trabajo? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('ocupacion_' . ($i + 1), '¿Cuál es el nombre de la ocupación, oficio o puesto? del contribuyente número ' . ($i + 1), 'required|alpha|max_length[50]');
                                $this->form_validation->set_rules('entrabajoes_' . ($i + 1), 'En su trabajo es,  del contribuyente número ' . ($i + 1), 'required|alpha|max_length[12]'); ////**checar cadena de error
                                $this->form_validation->set_rules('ingreso_' . ($i + 1), 'ingreso del contribuyente número ' . ($i + 1), 'required|numeric|max_length[6]');

                                $cad = 'recibegob_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibegob_' . ($i + 1), '¿Recibe dinero por programas de gobierno? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibejub_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibejub_' . ($i + 1), '¿Recibe dinero por jubilación o pensión? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotropais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotropais_' . ($i + 1), '¿Recibe ayuda de personas que viven en otro país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeestepais_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeestepais_' . ($i + 1), '¿Recibe ayuda de personas que viven en este país? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                                $cad = 'recibeotras_' . ($i + 1);
                                if ($postdata[$cad] != NULL) {
                                    $this->form_validation->set_rules('recibeotras_' . ($i + 1), '¿Recibe ayuda de otras fuentes? del contribuyente número ' . ($i + 1), 'required|alpha|exact_length[1]');
                                }
                            }
                            break;
                        }
                    default : {
                            echo "ninguno";
                        }
                }

                //var_dump($this->input->post());
                if ($this->form_validation->run() == FALSE) {
                    $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
                    //echo json_encode($data['errores']);
                    $this->load->view('registro/datosFamiliares', $data);
                } else {
                    $this->load->library('webservice');
                    $cad = "";


                    $postdata = $this->input->post();
                    //var_dump($postdata);
                    $datasend = array();

                    $datasend['id_usuario'] = $user->id_usuario;

                    $datasend['asp_mismodom'] = $postdata['asp_mismodom'];
                    if ($postdata['dependpadre'] != NULL) {
                        $cad = $cad . "," . $postdata['dependpadre'];
                    }
                    if ($postdata['dependmadre'] != NULL) {
                        $cad = $cad . "," . $postdata['dependmadre'];
                    }
                    if ($postdata['dependhermano'] != NULL) {
                        $cad = $cad . "," . $postdata['dependhermano'];
                    }
                    if ($postdata['dependfamiliares'] != NULL) {
                        $cad = $cad . "," . $postdata['dependfamiliares'];
                    }
                    if ($postdata['dependbeca'] != NULL) {
                        $cad = $cad . "," . $postdata['dependbeca'];
                    }
                    if ($postdata['dependyo'] != NULL) {
                        $cad = $cad . "," . $postdata['dependyo'];
                    }
                    if ($postdata['dependotros'] != NULL) {
                        $cad = $cad . "," . $postdata['dependotros'];
                    }


                    $datasend['asp_dependede'] = $cad;
                    $datasend['asp_cuantoscontribuyen'] = $postdata['asp_cuantoscontribuyen'];

                    $max = 0;
                    switch ($postdata['asp_cuantoscontribuyen']) {
                        case'1': $max = 1;
                            break;
                        case'2': $max = 2;
                            break;
                        case'3': $max = 3;
                            break;
                        case'4': $max = 4;
                            break;
                        case'5': $max = 5;
                            break;
                        default: $max = 0;
                            break;
                    }
                    //echo "max=" . ($max);

                    for ($i = 1; $i < $max + 1; $i++) {
                        $datasend['nombre_' . $i] = $postdata['nombre_' . $i];
                        $datasend['appaterno_' . $i] = $postdata['appaterno_' . $i];
                        $datasend['apmaterno_' . $i] = $postdata['apmaterno_' . $i];
                        $datasend['sexo_' . $i] = $postdata['sexo_' . $i];
                        $datasend['edad_' . $i] = $postdata['edad_' . $i];
                        $datasend['parentesco_' . $i] = $postdata['parentesco_' . $i];
                        $datasend['ultimogrado_' . $i] = $postdata['ultimogrado_' . $i];
                        $datasend['asisteescuela_' . $i] = $postdata['asisteescuela_' . $i];
                        $datasend['quehace_' . $i] = $postdata['quehace_' . $i];
                        $datasend['ocupacion_' . $i] = $postdata['ocupacion_' . $i];
                        $datasend['ingreso_' . $i] = $postdata['ingreso_' . $i];
                        $datasend['periodopago_' . $i] = "no_encontrado";

                        $datasend['recibegob_' . $i] = $postdata['recibegob_' . $i];
                        $datasend['recibejub_' . $i] = $postdata['recibejub_' . $i];
                        $datasend['recibeotropais_' . $i] = $postdata['recibeotropais_' . $i];
                        $datasend['recibeestepais_' . $i] = $postdata['recibeestepais_' . $i];
                        $datasend['recibeotras_' . $i] = $postdata['recibeotras_' . $i];
                        $datasend['entrabajoes_' . $i] = $postdata['entrabajoes_' . $i];
                    }

                    //var_dump($datasend);
                    $res = $this->webservice->guardaDatosFamiliares($datasend);
                    //echo$res->estatus;
                    if ($res->estatus == "OK") {
                        $this->session->set_flashdata('correcto', 'Datos familiares actualizados correctamente');
                        redirect('/cpanel');
                    }

//                    try {
//                        $this->load->model('asp/aspirante');
//                        $fecha = new DateTime('America/Mexico_City');
//                        $formato = $fecha->format("Y-m-d H:i:s");
//                        //echo $formato;
//                        $res1 = $this->aspirante->update($user->id_usuario, "datosFamiliares", 0, $formato);
//                        $res1 = $this->aspirante->update($user->id_usuario, "cuestionario", 1);
//                    } catch (Exception $ex) {
//                        
//                    }
                }
                //echo json_encode($this->input->post());
                //var_dump($this->input->post());
                //redirect('/ventas/editar/' . $id);
            } else {
                echo "no post";
                //redirect('/ventas/editar/' . $id);
            }
        } else {
            echo strtoupper($guardar);
            echo "guardar=false";
            //redirect('/ventas/editar/' . $id);
        }
    }

}

/* End of file welcome.php */
/* Locat*/
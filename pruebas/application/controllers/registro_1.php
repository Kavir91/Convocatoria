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
        $curp = $this->input->post('curp');
        $data['curp'] = '';
        $data['extr'] = false;
        if ($curp != false) {
            $data['curp'] = $curp;
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

//$postData_1=[];
            $postData_1["foliouv"] = $data->datosUsuario->folio;
            $postData_1["contrasena"] = $postData["asp_password"];
//echo "<br><br>checklogin:";
            $user = $this->webservice->checklogin($postData_1);

            $rec['id_usuario'] = $user->id_usuario;
//echo "<br><br>recuperar registro:";
            $asp = $this->webservice->recuperarRegistro($rec);

            $this->nativesession->set('user', $user);
            $this->nativesession->set('asp', $asp);

            $dataSend['resultado'] = $data;
            $this->load->view('registro/registroInicial_1', $dataSend);
        }
    }

    public function datosPersonales($guardar = false) {
        $user = $this->nativesession->get('user');
//        if ($user == NULL) {
//            redirect('/login2');
//            return;
//        }
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
                $this->form_validation->set_rules('asp_coloniadomicilio', 'colonia donde vives', 'numeric|max_length[4]');
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
                    
                    echo "<hr>";
                    var_dump($this->webservice->guardadatosparticulares($datos));
                }
            } else {
                redirect('/registro/datosPersonales');
            }
        } else {
            $this->load->view('registro/datosPersonales');
        }
    }

    public function datosEscolares($guardar = false) {
        $user = $this->nativesession->get('user');
//        if ($user == NULL) {
//            redirect('/login2');
//            return;
//        }
        if ($guardar == FALSE) {
            //solo mostrar la vista
            $this->load->view('registro/datosEscolares');
        } else if ($guardar == "true" || $guardar == "TRUE") {
            //guardar y mostrar la vista
            if ($this->input->post() != FALSE) {

                $postdata = $this->input->post();

                $this->load->library('form_validation');
                $datosEscuela = [];
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

    /* public function dps() {//datosPersonalesSave
      //var_dump($this->input->post());
      $this->load->library('form_validation');

      switch ($this->input->post('asp_gradoescuela')) {
      case "P": {//primaria
      echo "primaria";
      $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
      $datosEscuela['asp_gradoescuela'] = $this->input->post('asp_gradoescuela');
      break;
      }
      case "S": {//secundaria
      //echo "secundaria";
      $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
      $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|decimal|max_length[4]');
      $datosEscuela['asp_gradoescuela'] = $this->input->post('asp_gradoescuela');
      $datosEscuela['asp_promediosecundaria'] = $this->input->post('asp_promediosecundaria');
      break;
      }
      case "B": {//bachillerato
      echo "bachillerato concluido";
      $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
      $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|greater_than[1]|decimal|max_length[4]');
      $this->form_validation->set_rules('asp_promediobach', 'Promedio del bachillerato', 'greater_than[1]|decimal|max_length[4]');
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

      $this->form_validation->set_rules('asp_paisdomicilio', 'país donde vives', 'required|numeric|max_length[4]');
      $this->form_validation->set_rules('asp_estadodomicilio', 'estado donde vives', 'numeric|max_length[4]');
      $this->form_validation->set_rules('asp_municipiodomicilio', 'municipio donde vives', 'numeric|max_length[4]');
      $this->form_validation->set_rules('asp_localidaddomicilio', 'localidad donde vives', 'required|numeric|min_length[1]|max_length[20]');
      $this->form_validation->set_rules('asp_domicilio', 'domicilio donde vives', 'required|alpha|max_length[100]');
      $this->form_validation->set_rules('asp_coloniadomicilio', 'colonia donde vives', 'numeric|max_length[4]');
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

      break;
      }
      case "I": {//inscrito en bachillerato
      echo "inscrito en bachillerato";
      $this->form_validation->set_rules('asp_gradoescuela', 'Grado de estudios', 'required|alpha|max_length[1]');
      $this->form_validation->set_rules('asp_promediosecundaria', 'Promedio de la secundaria', 'required|greater_than[1]|decimal|max_length[4]');
      $this->form_validation->set_rules('asp_promediobach', 'Promedio del bachillerato', 'greater_than[1]|decimal|max_length[4]');
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

      $this->form_validation->set_rules('asp_paisdomicilio', 'país donde vives', 'required|numeric|max_length[4]');
      $this->form_validation->set_rules('asp_estadodomicilio', 'estado donde vives', 'numeric|max_length[4]');
      $this->form_validation->set_rules('asp_municipiodomicilio', 'municipio donde vives', 'numeric|max_length[4]');
      $this->form_validation->set_rules('asp_localidaddomicilio', 'localidad donde vives', 'required|numeric|min_length[1]|max_length[20]');
      $this->form_validation->set_rules('asp_domicilio', 'domicilio donde vives', 'required|alpha|max_length[100]');
      $this->form_validation->set_rules('asp_coloniadomicilio', 'colonia donde vives', 'numeric|max_length[4]');
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

      break;
      }
      default : {
      echo "no guardar nada";
      redirect('/cpanel');
      return;
      break;
      }
      }

      if ($this->form_validation->run() === FALSE) {
      $data['errores'] = $error_messages = $this->form_validation->getValidationErrorAsArray();
      //echo json_encode($data['errores']);
      //var_dump($this->input->post());
      $this->load->view('registro/datosPersonalesEsc', $data);
      } else {
      $this->load->library('webservice');
      $user = $this->nativesession->get('user');
      if ($user == false) {
      redirect('/login2');
      return;
      }
      //var_dump($user);
      //echo $user->id_usuario;
      echo "<br>";

      $postdata = $this->input->post();
      var_dump($postdata);

      /* $datosEscuela['id_usuario'] = $user->id_usuario;
      //echo('<p>'+$postdata['asp_escueladeprocedencia']+'</p>');
      $datosEscuela['pruebaid_escuela'] = $postdata['asp_escueladeprocedencia'];
      //            $datosEscuela['asp_anioingresobachillerato'] = $postdata['asp_anioingresoselect'];
      //            $datosEscuela['asp_anioegresobachillerato'] = $postdata['asp_mesegresoselect'];
      //            $datosEscuela['asp_mesegresobachillerato'] = $postdata['asp_anioegresoselect'];
      $datosEscuela['asp_anioingresoselect'] = $postdata['asp_anioingresoselect'];
      $datosEscuela['asp_mesegresoselect'] = $postdata['asp_mesegresoselect'];
      $datosEscuela['asp_anioegresoselect'] = $postdata['asp_anioegresoselect'];
      $datosEscuela['asp_areabachillerato'] = $postdata['asp_areabachillerato'];
      $datosEscuela['asp_gradoescuela'] = $postdata['asp_gradoescuela'];
      $datosEscuela['pruebaid_paisestudios'] = $postdata['asp_paisestudios'];//
      if ($postdata['asp_estudioenveracruz'] == "S") {//asp_estudioenveracruz
      $datosEscuela['pruebaid_estadoestudios'] = 1;
      } else {
      $datosEscuela['pruebaid_estadoestudios'] = $this->input->post('asp_estadoestudios');
      }
      $datosEscuela['asp_promediosecundaria'] = $postdata['asp_promediosecundaria'];
      $datosEscuela['asp_promediobach'] = $postdata['asp_promediobach'];
      $datosEscuela['asp_nopresentoexani1'] = $postdata['asp_nopresentoexani1'];
      $datosEscuela['asp_aniopresentoexani1'] = $postdata['asp_aniopresentoexani1']; */

//echo json_encode($datosEscuela);
    /* $res = $this->webservice->guardadatosescuela($datosEscuela);
      echo "<br>";
      echo json_encode($res);
      }
      } */

    public
            function datosFamiliares() {
        $this->load->view('registro/datosfamiliares');
    }

}

/* End of file welcome.php */
/* Locat */
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class catalogo extends CI_Controller {

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
        
    }

    public function carreras() {
        $municipio = $this->input->get('region');
        $modalidad = $this->input->get('modalidad');
        $carrera = $this->input->get('carrera');
        $this->load->database();

        if ($municipio != false || $carrera != false || $modalidad != false) {
            if ($municipio != false && $carrera != false && $modalidad != false) {
                $query = 'select * from carreras where car_id = %s and car_modalidad = "%s" and car_claveregion = %s and accesible = 1';
                /* $rec_carreras = Carrera::where('car_id', '=', $carrera)
                  ->where('car_modalidad', '=', $modalidad)
                  ->where('car_claveregion', '=', $municipio)
                  ->where('accesible', '=', 1)
                  ->get(); */
                //echo "<br>" . "1. esc_municipio!=false carrera!=false modalidad!=false <br>";
                //echo sprintf($query, $carrera, $modalidad, $municipio);
                $rec_carreras = $this->db->query(sprintf($query, $carrera, $modalidad, $municipio));
            } else {
                if ($municipio != false && $carrera != false) {
                    $query = 'select * from carreras where car_id = $s and car_claveregion = %s and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_id', '=', $carrera)
                      ->where('car_claveregion', '=', $municipio)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "2. esc_municipio!=false carrera!=false <br>";
                    //echo sprintf($query, $carrera, $municipio);
                    $rec_carreras = $this->db->query(sprintf($query, $carrera, $municipio));
                } else
                if ($municipio != false && $modalidad != false) {
                    $query = 'select * from carreras where car_modalidad = "%s" and car_claveregion = %s and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_modalidad', '=', $modalidad)
                      ->where('car_claveregion', '=', $municipio)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "3. esc_municipio!=false modalidad!=false <br>";
                    //echo sprintf($query, $modalidad, $municipio);
                    $rec_carreras = $this->db->query(sprintf($query, $modalidad, $municipio));
                } else
                if ($carrera != false && $modalidad != false) {
                    $query = 'select * from carreras where car_id = %s and car_modalidad = "%s" and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_id', '=', $carrera)
                      ->where('car_modalidad', '=', $modalidad)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "4. carrera!=false modadlidad!=false <br>";
                    //echo sprintf($query, $carrera, $modalidad);
                    $rec_carreras = $this->db->query(sprintf($query, $carrera, $modalidad));
                } else
                if ($carrera != false) {
                    $query = 'select * from carreras where car_id = %s and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_id', '=', $carrera)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "5. carrera!=false <br>";
                    //echo sprintf($query, $carrera);
                    $rec_carreras = $this->db->query(sprintf($query, $carrera));
                } else
                if ($modalidad != false) {
                    $query = 'select * from carreras where car_modalidad = "%s" and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_modalidad', '=', $modalidad)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "6. modalidad!=false <br>";
                    //echo sprintf($query, $modalidad);
                    $rec_carreras = $this->db->query(sprintf($query, $modalidad));
                } else
                if ($municipio != false) {
                    $query = 'select * from carreras where car_claveregion = "%s" and accesible = 1';
                    /* $rec_carreras = Carrera::where('car_claveregion', '=', $municipio)
                      ->where('accesible', '=', 1)
                      ->get(); */
                    //echo "<br>" . "7. esc_municipio!=false <br>";
                    //echo sprintf($query, $municipio);
                    $rec_carreras = $this->db->query(sprintf($query, $municipio));
                }
            }
        } else {
            $query = 'select * from carreras where car_id = %s limit 1';
            //$rec_carreras = Carrera::find(-1);
            echo "<br>" . "8. todos false";
            $rec_carreras = $this->db->query(sprintf($query, "-1"));
        }
        //echo $head = '<!DOCTYPE html><html><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/></head><body>';
        //echo var_dump($rec_carreras,JSON_UNESCAPED_UNICODE);
        echo json_encode($rec_carreras->result(), 256);
        //var_dump($rec_carreras->result());
    }

    public function municipios() {
        $estado = FALSE;
        if ($this->input->get('asp_estadonacimiento') != false) {
            $estado = $this->input->get('asp_estadonacimiento');
        } else {
            $estado = $this->input->post('asp_estadonacimiento');
        }


        if ($estado != false) {
            $query = 'select * from municipios where mun_estado = %s';
            /* $rec_muns = Municipio::where('mun_estado', '=', $estado)
              ->get(); */
            $rec_muns = $this->db->query(sprintf($query, $estado));
        } else {
            $query = 'select * from municipios where mun_estado = %s';
            $rec_muns = $this->db->query(sprintf($query, -1));
        }

        //echo $head = '<!DOCTYPE html><html><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/></head><body>';
        //echo $rec_muns->toJson(JSON_UNESCAPED_UNICODE);
        echo json_encode($rec_muns->result());
    }

    public function paises() {
        $pais = $this->input->get('pais');

        if ($pais != false) {
            $query = 'select * from paises where pai_id = %s';
            /* $rec_pais = Pais::where('pai_id', '=', $pais)
              ->get(); */
            //select * from "municipios" where "mun_estado" = ?"
            $rec_pais = $this->db->query(sprintf($query, $pais));
        } else {
            $query = 'select * from paises';
            //$rec_pais = Pais::all();
            $rec_pais = $this->db->query($query);
        }
        //echo $head = '<!DOCTYPE html><html><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/></head><body>';
        //echo $rec_pais->toJson(JSON_UNESCAPED_UNICODE);
        echo json_encode($rec_pais->result());
    }

    public function Escuelas() {
        $municipio = $this->input->get('municipio');
        $sector = $this->input->get('sector');
        $turno = $this->input->get('turno');
        //echo json_encode($this->input->get());
        //echo EscuelaProcedencia::buscar($municipio, $sector, $turno)->toJson(JSON_UNESCAPED_UNICODE);

        if ($municipio != false && $sector != false && $turno != false) {
            if ($sector == "PRIVADO" && $turno == "MATUTINO") {
                //echo "<br>" . "1. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where('esc_sectorescuela', '=', 'P')
                  ->where('esc_turno', '=', '1')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_sectorescuela = "%s" and esc_turno = %s';
                //echo sprintf($query, $municipio, "P", "1");
                $escuelas = $this->db->query(sprintf($query, $municipio, "P", "1"));
            } else if ($sector == "PRIVADO" && $turno == "VESPERTINO") {
                //echo "<br>" . "2. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where('esc_sectorescuela', '=', 'P')
                  ->where('esc_turno', '=', '2')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_sectorescuela = "%s" and esc_turno = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio, "P", "2"));
            } else if ($sector == "PRIVADO" && $turno == "OTRO") {
                //echo "<br>" . "3. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where('esc_sectorescuela', '=', 'P')
                  ->where(function($query) {
                  $query->where('esc_turno', '<>', '1')
                  ->where('esc_turno', '<>', '2');
                  })
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_sectorescuela = "%s" and (esc_turno <> "%s" and esc_turno <> %s)';
                $escuelas = $this->db->query(sprintf($query, $municipio, "P", "1", "2"));
            } else if ($sector == "PUBLICO" && $turno == "MATUTINO") {
                //echo "<br>" . "4. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->orwhere('esc_sectorescuela', '=', 'E')
                  ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                  })
                  ->where('esc_turno', '=', '1')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela = "%s" or esc_sectorescuela = "%s") and esc_turno = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "1"));
            } else if ($sector == "PUBLICO" && $turno == "VESPERTINO") {
                //echo "<br>" . "5. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->where('esc_sectorescuela', '=', 'E')
                  ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                  })
                  ->where('esc_turno', '=', '2')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela = "%s" or esc_sectorescuela = "%s") and esc_turno = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "2"));
            } else if ($sector == "PUBLICO" && $turno == "OTRO") {
                //echo "<br>" . "6. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->where('esc_sectorescuela', '=', 'E')
                  ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                  })
                  ->where(function($query) {
                  $query->where('esc_turno', '<>', '1')
                  ->where('esc_turno', '<>', '2');
                  })
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela = "%s" or esc_sectorescuela = "%s") and (esc_turno <> %s and esc_turno <> %s)';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "1", "2"));
            } else if ($sector == "OTRO" && $turno == "MATUTINO") {
                //echo "<br>" . "7. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->where('esc_sectorescuela', '<>', 'E')
                  ->where('esc_sectorescuela', '<>', 'F')
                  ->where('esc_sectorescuela', '<>', 'P');
                  })
                  ->where('esc_turno', '=', '1')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and esc_turno = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "P", "1"));
            } else if ($sector == "OTRO" && $turno == "VESPERTINO") {
                //echo "<br>" . "8. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->where('esc_sectorescuela', '<>', 'E')
                  ->where('esc_sectorescuela', '<>', 'F')
                  ->where('esc_sectorescuela', '<>', 'P');
                  })
                  ->where('esc_turno', '=', '2')
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and "esc_turno" = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "P", "2"));
            } else if ($sector == "OTRO" && $turno == "OTRO") {
                //echo "<br>" . "9. ";//CORRECTO
                /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                  ->Where(function($query) {
                  $query->where('esc_sectorescuela', '<>', 'E')
                  ->where('esc_sectorescuela', '<>', 'F')
                  ->where('esc_sectorescuela', '<>', 'P');
                  })
                  ->where(function($query) {
                  $query->where('esc_turno', '<>', '1')
                  ->where('esc_turno', '<>', '2');
                  })
                  ->get(); */
                $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and (esc_turno <> %s and esc_turno <> %s)';
                $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "P", "1", "2"));
            }
        } else {//////////////////////////////////////////////////////////////////////////////////////////////////
            if ($municipio != false && $sector != false) {
                if ($sector == "PUBLICO") {
                    //echo "<br>" . "10. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where(function($query) {
                      $query->orwhere('esc_sectorescuela', '=', 'E')
                      ->orwhere('esc_sectorescuela', '=', 'F');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela = "%s" or esc_sectorescuela = "%s")';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F"));
                } else if ($sector == "PRIVADO") {
                    //echo "<br>" . "11. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where('esc_sectorescuela', '=', 'P')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_sectorescuela = "%s"';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "P"));
                } else if ($sector == "OTRO") {
                    //echo "<br>" . "12. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where(function($query) {
                      $query->where('esc_sectorescuela', '<>', 'E')
                      ->where('esc_sectorescuela', '<>', 'F')
                      ->where('esc_sectorescuela', '<>', 'P');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s")';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "E", "F", "P"));
                }
            } else
            if ($municipio != false && $turno != false) {
                if ($turno == "MATUTINO") {
                    //echo "<br>" . "13. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where('esc_turno', '=', '1')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_turno = "%s"';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "1"));
                } else if ($turno == "VESPERTINO") {
                    //echo "<br>" . "14. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where('esc_turno', '=', '2')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and esc_turno = "%s"';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "2"));
                } else if ($turno == "OTRO") {
                    echo "<br>" . "15. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                      ->Where(function($query) {
                      $query->where('esc_turno', '<>', '1')
                      ->where('esc_turno', '<>', '2');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_municipio = "%s" and (esc_turno <> "%s" and esc_turno <> "%s")';
                    $escuelas = $this->db->query(sprintf($query, $municipio, "1", "2"));
                }
            } else
            if ($sector != false && $turno != false) {
                if ($sector == "PRIVADO" && $turno == "MATUTINO") {
                    //echo "<br>" . "16. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                      ->where('esc_turno', '=', '1')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_sectorescuela = "%s" and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "P", "1"));
                } else if ($sector == "PRIVADO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "17. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                      ->where('esc_turno', '=', '2')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_sectorescuela = "%s" and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "P", "2"));
                } else if ($sector == "PRIVADO" && $turno == "OTRO") {
                    //echo "<br>" . "18. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                      ->where(function($query) {
                      $query->where('esc_turno', '<>', '1')
                      ->where('esc_turno', '<>', '2');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_sectorescuela = "%s" and (esc_turno <> %s and esc_turno <> %s)';
                    $escuelas = $this->db->query(sprintf($query, "P", "1", "2"));
                } else if ($sector == "PUBLICO" && $turno == "MATUTINO") {
                    //echo "<br>" . "19. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->orwhere('esc_sectorescuela', '=', 'E')
                      ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                      })
                      ->where('esc_turno', '=', '1')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela = "%s" or esc_sectorescuela = "%s") and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "1"));
                } else if ($sector == "PUBLICO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "20. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->where('esc_sectorescuela', '=', 'E')
                      ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                      })
                      ->where('esc_turno', '=', '2')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela = %s or esc_sectorescuela = %s) and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "2"));
                } else if ($sector == "PUBLICO" && $turno == "OTRO") {
                    //echo "<br>" . "21. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->where('esc_sectorescuela', '=', 'E')
                      ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                      })
                      ->where(function($query) {
                      $query->where('esc_turno', '<>', '1')
                      ->where('esc_turno', '<>', '2');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela = "%s" or esc_sectorescuela = "%s") and (esc_turno <> %s and esc_turno <> %s)';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "1", "2"));
                } else if ($sector == "OTRO" && $turno == "MATUTINO") {
                    //echo "<br>" . "22. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->where('esc_sectorescuela', '<>', 'E')
                      ->where('esc_sectorescuela', '<>', 'F')
                      ->where('esc_sectorescuela', '<>', 'P');
                      })
                      ->where('esc_turno', '=', '1')
                      ->get(); */

                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "P", "1"));
                } else if ($sector == "OTRO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "23. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->where('esc_sectorescuela', '<>', 'E')
                      ->where('esc_sectorescuela', '<>', 'F')
                      ->where('esc_sectorescuela', '<>', 'P');
                      })
                      ->where('esc_turno', '=', '2')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "P", "2"));
                } else if ($sector == "OTRO" && $turno == "OTRO") {
                    //echo "<br>" . "24. "; //CORRECTO
                    /* $escuelas = EscuelaProcedencia::Where(function($query) {
                      $query->where('esc_sectorescuela', '<>', 'E')
                      ->where('esc_sectorescuela', '<>', 'F')
                      ->where('esc_sectorescuela', '<>', 'P');
                      })
                      ->where(function($query) {
                      $query->where('esc_turno', '<>', '1')
                      ->where('esc_turno', '<>', '2');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s") and (esc_turno <> %s and esc_turno <> %s)';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "P", "2"));
                }
            } else
            if ($sector != false) {
                if ($sector == "PRIVADO") {
                    //echo "<br>" . "25. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_sectorescuela', '=', "P")
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_sectorescuela = "%s"';
                    $escuelas = $this->db->query(sprintf($query, "P"));
                } else if ($sector == "PUBLICO") {
                    //echo "<br>" . "26. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_sectorescuela', '=', 'E')
                      ->orwhere('esc_sectorescuela', '=', 'F')
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_sectorescuela = "%s" or esc_sectorescuela = "%s"';
                    $escuelas = $this->db->query(sprintf($query, "E", "F"));
                } else if ($sector == "OTRO") {
                    //echo "<br>" . "27. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where(function($query) {
                      $query->where('esc_sectorescuela', '<>', 'E')
                      ->where('esc_sectorescuela', '<>', 'F')
                      ->where('esc_sectorescuela', '<>', 'P');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s" and esc_sectorescuela <> "%s")';
                    $escuelas = $this->db->query(sprintf($query, "E", "F", "P"));
                }
            } else
            if ($turno != false) {
                if ($turno == "MATUTINO") {
                    //echo "<br>" . "28. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_turno', '=', 1)
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "1"));
                } else if ($turno == "VESPERTINO") {
                    //echo "<br>" . "29. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where('esc_turno', '=', 2)
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where esc_turno = %s';
                    $escuelas = $this->db->query(sprintf($query, "2"));
                } else if ($turno == "OTRO") {
                    //echo "<br>" . "30. ";//CORRECTO
                    /* $escuelas = EscuelaProcedencia::where(function($query) {
                      $query->where('esc_turno', '<>', '1')
                      ->where('esc_turno', '<>', '2');
                      })
                      ->get(); */
                    $query = 'select * from escueladeprocedencia where (esc_turno <> %s and esc_turno <> %s)';
                    $escuelas = $this->db->query(sprintf($query, "1", "2"));
                }
            } else
            if ($municipio != false) {
                /*$escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->get();*/
                $query='select * from escueladeprocedencia where esc_municipio = %s';
                $escuelas = $this->db->query(sprintf($query, $municipio));
            }
        }
        echo json_encode($escuelas->result());
    }

    public function localidades() {
        $municipio = $this->input->get('municipio');
        $municipioNom = $this->input->get('municipionom');
        if ($municipio != false) {
            //echo"municipio<br>";
            /* $localidades = Localidad::where('loc_municipio', '=', $municipio)
              ->get(); */
            $query = 'select * from localidades where loc_municipio = %s';
            $localidades = $this->db->query(sprintf($query, $municipio));
        } else if ($municipioNom != false) {
            //echo"municipionom<br>";
            /* $munID = Municipio::where('mun_nombre', '=', strtoupper($municipioNom))
              ->get()->first(); */
            $query = 'select * from municipios where mun_nombre = "%s" limit 1';
            $munID = $this->db->query(sprintf($query, strtoupper($municipioNom)));
            //var_dump($munID->result()[0]->mun_id);

            /* $localidades = Localidad::where('loc_municipio', '=', $munID->results()->mun_id)
              ->get(); */
            $query = 'select * from localidades where loc_municipio = %s';
            $res = $munID->result();
            $localidades = $this->db->query(sprintf($query, $res[0]->mun_id));
            //var_dump($localidades->result());
        } else {
            $query = 'select * from localidades where loc_municipio = %s';
            $localidades = $this->db->query(sprintf($query, -1));
            //echo"default<br>";
            //$localidades = Localidad::where('loc_municipio', '=', -1)
            //      ->get();
            //select * from "localidades" where "loc_municipio" = ?
        }
        //echo $localidades->toJson(JSON_UNESCAPED_UNICODE);
        echo json_encode($localidades->result());
    }

    public function estados() {
        //echo Estado::all()->toJson(JSON_UNESCAPED_UNICODE);
        /* echo Estado::where(function($query) {
          $query->where('est_id', '<>', '1')
          ->where('est_id', '<>', '33');
          })
          ->get()->toJson(JSON_UNESCAPED_UNICODE); */
        $query = 'select * from estados where (est_id <> %s and est_id <> %s)';

        $rec_ests = $this->db->query(sprintf($query, 1, 33));
        echo json_encode($rec_ests->result());
    }

    public function colonias() {
        $municipio = $this->input->get('municipio');
        $estado=$this->input->get('estado');
        //$municipioNom = $this->input->get('municipionom');
        //$localidad = $this->input->get('localidad');
        //$localidadNom = $this->input->get('localidadnom');
        //$rec_cols =  Array;

        if ($municipio != false) {
            /* $rec_cols = Colonia::where('col_clavemunicipio', '=', $municipio)
              ->get(); */
            $query = 'select * from colonias where col_clavemunicipio = %s and col_claveestado = %s';
            $rec_cols = $this->db->query(sprintf($query, $municipio,$estado));
        }
        echo json_encode($rec_cols->result());
        //echo $rec_cols->toJson(JSON_UNESCAPED_UNICODE);
        //echo "<br>" . "8. todos false";
    }

}

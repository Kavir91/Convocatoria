<?php

class preguntas extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function find($id) {
        $CI = & get_instance();
        $CI->load->model('cuestionario/respuestas');

        $query = 'select cup_id,cup_numeropregunta,cup_nombre from preguntas where cup_id= "%s" and cup_exani=2';
        $res = $this->db->query(sprintf($query, $id));
        $result = $res->result();
        foreach ($result as $value) {
            $value->respuestas = $CI->respuestas->find($value->cup_numeropregunta);
        }
        return $result;
    }

    function all() {
        $CI = & get_instance();
        $CI->load->model('cuestionario/respuestas');
        $query = 'select cup_id,cup_numeropregunta,cup_nombre from preguntas where cup_exani=2';
        $res = $this->db->query($query);
        $result = $res->result();
        foreach ($result as $value) {
            $value->respuestas = $CI->respuestas->find($value->cup_numeropregunta);
        }
        return $result;
    }

    function getNext($id = 0) {
        $ids = $this->getPreguntaIds();
        if ($id <= 0) {
            if (count($ids) >= 2) {
                $preguntas['anterior'] = NULL;
                $preguntas['actual'] = $ids[0];
                $preguntas['siguiente'] = $ids[1];
            } else if (count($ids) == 1) {
                $preguntas['anterior'] = NULL;
                $preguntas['actual'] = $ids[0];
                $preguntas['siguiente'] = NULL;
            } else if (count($ids) < 1) {
                $preguntas['anterior'] = NULL;
                $preguntas['actual'] = NULL;
                $preguntas['siguiente'] = NULL;
            }
        } else {
            if (count($ids) > 2) {
                $preguntas['anterior'] = NULL;
                $preguntas['actual'] = NULL;
                $preguntas['siguiente'] = NULL;

                //echo "mayor > 2<br>";
                $key = array_search($id, $ids);

                //echo "key=" . $key . "<br>";
                if ($key !== FALSE) {
                    if ($key >= 0) {
                        if ($key == 0) {
                            //echo "key == 0<br>";
                            $preguntas['anterior'] = NULL;
                            $preguntas['actual'] = $ids[$key];
                            $preguntas['siguiente'] = $ids[$key + 1];
                        } else if ($key == 1) {
                            //echo "key == 1<br>";
                            $preguntas['anterior'] = $ids[$key - 1];
                            $preguntas['actual'] = $ids[$key];
                            $preguntas['siguiente'] = $ids[$key + 1];
                        } else if ($key > 1) {
                            //echo "key > 1<br>";
                            if ($key + 1 < count($ids)) {
                                $preguntas['anterior'] = $ids[$key - 1];
                                $preguntas['actual'] = $ids[$key];
                                $preguntas['siguiente'] = $ids[$key + 1];
                            } else {
                                $preguntas['anterior'] = $ids[$key - 1];
                                $preguntas['actual'] = $ids[$key];
                                $preguntas['siguiente'] = NULL;
                            }
                        }
                    } else {
                        
                    }
                } else {
                    echo "key null";
                }
            }
            if (count($ids) == 2) {
                $key = array_search($id, $ids);
                if ($key != NULL && $key != false) {
                    if ($key == 0) {
                        $preguntas['anterior'] = NULL;
                        $preguntas['actual'] = $ids[$key];
                        $preguntas['siguiente'] = $ids[$key + 1];
                    } else if ($key == 1) {
                        $preguntas['anterior'] = $ids[$key - 1];
                        $preguntas['actual'] = $ids[$key];
                        $preguntas['siguiente'] = NULL;
                    }
                }
            } else if (count($ids) == 1) {
                $key = array_search($id, $ids);
                if ($key != NULL && $key != false) {
                    $preguntas['anterior'] = NULL;
                    $preguntas['actual'] = $ids[$key];
                    $preguntas['siguiente'] = NULL;
                }
            } else if (count($ids) < 1) {
                $preguntas['anterior'] = NULL;
                $preguntas['actual'] = NULL;
                $preguntas['siguiente'] = NULL;
            }
        }
        $preguntas['total']=count($ids);
        return $preguntas;
    }

    function getPreguntaIds() {
        $CI = & get_instance();
        $CI->load->model('cuestionario/respuestas');
        $query = 'select cup_id from preguntas where cup_exani=2';
        $res = $this->db->query($query);
        $result = $res->result();
        $r = array();
        foreach ($result as $ss) {
            $r[] = $ss->cup_id;
        }
        //return $result;
        return $r;
    }

}

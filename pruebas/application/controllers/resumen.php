<?php

/**
 * Description of resumen
 *
 * @author Cristhian
 */
class resumen extends CI_Controller {

    public function index() {
        $this->load->library('webservice');
        $res = $this->webservice->getAsp();
        $res1 = json_decode($res);

        $resultado = Array();
        foreach ($res1 as $key => $value) {
            if ($key != "conteo" && $value->asp_id != 34448) {
                $rec['id_usuario'] = $value->asp_id;
                $asp = $this->webservice->recuperarRegistroDEV($rec);
                if ($asp != NULL) {
                    $value->carrera = $asp->solicitudes[0]->car_nombrecarrera;
                }
                $resultado["A" . $key] = $value;
                //print "$key => $value\n";
            }
        }
        //echo json_encode($resultado);
        try {
            $this->load->model('asp/aspirante');
            $this->load->library('webservice');
            foreach ($resultado as $item) {
                $res = $this->aspirante->add($item->asp_id, $item->asp_foliouvclave, 0);
            }
        } catch (Exception $ex) {
//            echo $ex->getTrace()[0]['args'][1][0] . "<br>";
//            echo $ex->getTrace()[0]['args'][1][1] . "<br>";
//            echo $ex->getTrace()[0]['args'][1][2] . "<br>";
        }


        $data['aspirante'] = $resultado;
        $this->load->view('resumen/resumen', $data);
    }

}

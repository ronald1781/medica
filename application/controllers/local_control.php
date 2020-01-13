<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_control extends CI_Controller {

 public function __construct()
 {
    parent::__construct();
    $this->load->model('local_model');
               // $this->load->helper('url_helper');
}
public function index()
{
  
   $valid = $this->session->userdata('validated');
   if ($valid == TRUE) {
      $datos['titulo'] = 'Local';
      $datos['contenido'] = 'local_view';
      $this->load->view('includes/plantilla', $datos);
  } else {
      $this->session->set_flashdata('message_name', $result);
      redirect('login','refresh');
  }
  
}	
/* nueva version de Cargo */

public function ajax_list() {
    $this->load->model('cargo_model');
    $list = $this->cargo_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $person) {
        $no++;
        $row = array();
        $row[] = ucfirst(strtolower($person->nomcarg));
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
        $row[] = '<a href="javascript:void()" title="Editar" onclick="edit_person(' . "'" . $person->codcarg . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
        <a href="javascript:void()" title="Anular" onclick="delete_person(' . "'" . $person->codcarg . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
        $data[] = $row;
    }
    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->cargo_model->count_all(),
        "recordsFiltered" => $this->cargo_model->count_filtered(),
        "data" => $data,
    );
        //output to json format
    echo json_encode($output);
}

public function ajax_edit($id) {
    $data = $this->cargo_model->get_by_id($id);
    echo json_encode($data);
}

public function ajax_add() {
 $nomacc= $this->input->post('nomcarg');
 $data = array(
    'nomcarg' => $nomacc,
    'usucrcarg' => $this->session->userdata('codiper'),
);
 $insert = $this->cargo_model->save($data);
 if ($insert > 0) {
    $dato = 'Correctamente,  Cargo : ' . $nomacc;
} else {
    $dato = 'Fallo!!!';
}
echo json_encode(array("status" => $dato));
}

public function ajax_update() {
 $datmd= $this->input->post('nomcarg');
 $data = array(
    'nomcarg' => $datmd,
    'usumdcarg' => $this->session->userdata('codiper'),
    'fmdcarg' => gmdate("Y-m-d H:i:s", time() - 18000),
);
 $result = $this->cargo_model->update(array('codcarg' => $this->input->post('codcarg')), $data);
 if ($result >0) {
    $dato = 'Correctamente : '.$datmd.', '.$result.' Fila (s) Actualizado (s)';
} else {
    $dato = 'Fallo!!!';
}
echo json_encode(array("status" => $dato));
}

public function ajax_delete($id) {
  $result=  $this->cargo_model->delete_by_id($id);
  if ($result>0) {
    $dato = 'Correctamente '.$result.' Fila (s) Anulado (s)';
} else {
    $dato = 'Fallo!!!';
}
echo json_encode(array("status" => $dato));
}


}

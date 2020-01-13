<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_control extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('consulta_model');
               // $this->load->helper('url_helper');
}
public function index()
{
  $valid = $this->session->userdata('validated');
  if ($valid == TRUE) {
    $datos['titulo'] = 'Consulta';
    $datos['contenido'] = 'consulta_view';
    $this->load->view('includes/plantilla', $datos);
  } else {
    $this->session->set_flashdata('message_name', $result);
    redirect('login','refresh');
  } 
}

public function cita_a_consulta()
{
  $valid = $this->session->userdata('validated');
  if ($valid == TRUE) {
    $datos['titulo'] = 'Citas';
    $datos['contenido'] = 'citas_view';
    $this->load->view('includes/plantilla', $datos);
  } else {
    $this->session->set_flashdata('message_name', $result);
    redirect('login','refresh');
  } 
}	

public function ajax_list_consulta() {
$fecha=gmdate("Y-m-d", time() - 18000);
$hi='00:00:00';
$hf='23:59:59';
  $datas['selespe'] = intval($this->input->post('selespe'));
  $datas['selmedi'] = intval($this->input->post('selmedi'));
  $datas['fechadesde'] = ($this->input->post('fechadesde')=='')?$fecha.' '.$hi:$this->input->post('fechadesde').' '.$hi;
  $datas['fechahasta'] = ($this->input->post('fechahasta')=='')?$fecha.' '.$hf:$this->input->post('fechahasta').' '.$hf;
  $datas['selpacis'] = $this->input->post('selpacis');
  $list = $this->consulta_model->get_datatables_consulta($datas);
  $data = array();
  $no = $_POST['start'];
  $con=0;
  $estadopgo='';
  foreach ($list as $consulta) {
          //'codclt','citaclt','codpac','codmed','mtvclt','diagclt','impclt','moneclt','cantclt','descclt','estpgoclt','iniateclt','finateclt','paciente','medico', 'nomesp','nomsrv','nommone'
    $no++;
    $row = array();
    $row[] = $consulta->codclt;
    $row[] = ucfirst(strtolower($consulta->iniateclt));
    $row[] = ucfirst(strtolower($consulta->paciente));    
    $row[] = ucfirst(strtolower($consulta->nomesp));
    $row[] = ucfirst(strtolower($consulta->medico));
    $row[] = ucfirst(strtolower($consulta->nomsrv));
    $row[] = ucfirst(strtolower($consulta->smbmone)).' '.ucfirst(strtolower($consulta->impclt));
    
     $estadopgo= $consulta->estpgoclt;
    switch($estadopgo){
      case '0':
      $estadopgo='<span class="label label-warning">Pendiente</span>';
      break;
      case '1':
      $estadopgo='<span class="label label-success">Pagado</span>';
      break;      
      default:
      $estadopgo='';
      break;
    }
    $row[] = $estadopgo;
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
    $row[] = '<a href="javascript:void()" title="Finalizar" onclick="edit_consulta(' . "'" . $consulta->codclt . "'" . ')"><span class="label label-success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></a>
    <a href="javascript:void()" title="Vista" onclick="vista_consulta(' . "'" . $consulta->codclt . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
    <a href="javascript:void()" title="Anular" onclick="delete_consulta(' . "'" . $consulta->codclt . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
    $data[] = $row;
  }
  $output = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => $this->consulta_model->count_all_consulta($datas),
    "recordsFiltered" => $this->consulta_model->count_filtered_consulta($datas),
    "data" => $data,
  );  
  echo json_encode($output);
}

public function ajax_edit_consulta($id) {
  $data = $this->consulta_model->get_by_id_consulta($id);
  echo json_encode($data);
}
public function ajax_vista_consulta($id) {
  $data = $this->consulta_model->get_by_id_consulta($id);
  echo json_encode($data);
}
public function ajax_add_conslta() {
  //selespe,selmedi,selpaci,fechacita,horacita,selserv
  //codecit,codeemp,codecn,codepac,codmed,codesp,motcit,odbscit,ordencit,fechcit,horacit,estcit,usucrcit,fecrcit,usumdcit,fecmdcit,estrgcit
  $codesp = $this->input->post('selespe');
  $codmed = $this->input->post('selmedi');
  $codepac = $this->input->post('selpaci');
  $fechcit = $this->input->post('fechacita');
  $horacit = $this->input->post('horacita');
  $motcit = $this->input->post('selserv');
  $odbscit = $this->input->post('traobsserv');
  $data = array(
    'codeemp'=>$this->session->userdata('codemp'),
    'codecn'=>$this->session->userdata('codloca'),
    'codepac'=>$codepac,       
    'codmed'=>$codmed,
    'codesp'=>$codesp,    
    'motcit'=>$motcit,
    'odbscit'=>$odbscit,
    'fechcit'=>$fechcit,
    'horacit'=>$horacit,
    'estcit'=>'G',
    'usucrcit' => $this->session->userdata('codiper'),
  );
  $insert = $this->consulta_model->save_consulta($data);
  if ($insert > 0) {
    $dato = 'Correctamente,  Cita para : ' . $fechcit.' '.$horacit;
  } else {
    $dato = 'Fallo!!!';
  }
  echo json_encode(array("status" => $dato));
}

public function ajax_update_consulta() {
  $codesp = $this->input->post('selespe');
  $codmed = $this->input->post('selmedi');
  $codepac = $this->input->post('selpaci');
  $fechcit = $this->input->post('fechacita');
  $horacit = $this->input->post('horacita');
  $motcit = $this->input->post('selserv');
  $odbscit = $this->input->post('traobsserv');
  $data = array(    
    'codepac'=>$codepac,       
    'codmed'=>$codmed,
    'codesp'=>$codesp,    
    'motcit'=>$motcit,
    'odbscit'=>$odbscit,
    'fechcit'=>$fechcit,
    'horacit'=>$horacit,
    'usumdcit' => $this->session->userdata('codiper'),
    'fecmdcit' => gmdate("Y-m-d H:i:s", time() - 18000),
  );  
  $result = $this->consulta_model->update_consulta(array('codclt' => $this->input->post('codcita')), $data);
  if ($result > 0) {
    $dato = 'Correctamente : ' . $this->input->post('codcita'). ', ' . $result . ' Fila (s) Actualizado (s)';
  } else {
    $dato = 'Fallo!!! '.$result;
  }
  echo json_encode(array("status" => $dato));
}

public function ajax_delete_consulta($id) {
  $result = $this->consulta_model->delete_by_id_consulta($id);
  if ($result > 0) {
    $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
  } else {
    $dato = 'Fallo!!! '.$result;
  }
  echo json_encode(array("status" => $dato));
}



}

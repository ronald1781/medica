<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas_control extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('citas_model');
               // $this->load->helper('url_helper');
}
public function index()
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

public function ajax_list_citas() {
  $fecha=gmdate("Y-m-d", time() - 18000);
  $datas['selespe'] = intval($this->input->post('selespe'));
  $datas['selmedi'] = intval($this->input->post('selmedi'));
  $datas['fechadesde'] = ($this->input->post('fechadesde')=='')?$fecha:$this->input->post('fechadesde');
  $datas['fechahasta'] = ($this->input->post('fechahasta')=='')?$fecha:$this->input->post('fechahasta');
  $datas['selesta'] = $this->input->post('selesta');
  $list = $this->citas_model->get_datatables_cita($datas);
  $data = array();
  $no = $_POST['start'];
  $con=0;
  $acciones='';
  $stado='';
  foreach ($list as $person) {
          //'','codesp','motcit','odbscit','fechcit','horacit','nrodocpte','paciente','medico','nomesp'
    $no++;
    $row = array();
    $row[] = $person->codecit;
    $row[] = ucfirst(strtolower($person->paciente));
    $row[] = ucfirst(strtolower($person->nomesp));
    $row[] = ucfirst(strtolower($person->medico));
    $row[] = ucfirst(strtolower($person->fechcit)).' '.ucfirst(strtolower($person->horacit));
    $row[] = ucfirst(strtolower($person->nomsrv));
    
    $estado= $person->estcit;
    switch($estado){
      case 'G':
      $stado='<span class="label label-primary">'.ucfirst(strtolower($person->nommlttb)).'</span>';
      break;
      case 'A':
      $stado='<span class="label label-success">'.ucfirst(strtolower($person->nommlttb)).'</span>';
      break;
      case 'I':
      $stado='<span class="label label-warning">'.ucfirst(strtolower($person->nommlttb)).'</span>';
      break;
      case 'N':
      $stado='<span class="label label-info">'.ucfirst(strtolower($person->nommlttb)).'</span>';
      break;
      default:
      $acciones='';
      break;
    }

    $row[] = $stado;
    
    switch ($estado) {
      case 'G':
      $acciones='<a href="javascript:void()" title="Editar" onclick="edit_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
      <a href="javascript:void()" title="Atender" onclick="atender_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></a>
      <a href="javascript:void()" title="Imprimir" onclick="imprimir_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-warning"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
      <a href="javascript:void()" title="Llamar" onclick="llamar_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-primary"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
      <a href="javascript:void()" title="Anular" onclick="delete_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
      break;
      case 'A':
      $acciones=' <a href="javascript:void()" title="Imprimir" onclick="imprimir_cita(' . "'" . $person->codecit . "'" . ')"><span class="label label-warning"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>';
      break;
      default:
      $acciones='';
      break;
    }
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
    $row[] = $acciones;
    $data[] = $row;
  }
  $output = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => $this->citas_model->count_all_cita($datas),
    "recordsFiltered" => $this->citas_model->count_filtered_cita($datas),
    "data" => $data,
  );  
  echo json_encode($output);
  
}

public function ajax_edit_cita($id) {
  $data = $this->citas_model->get_by_id_cita($id);
  echo json_encode($data);
}

public function ajax_add_cita() {
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
  $insert = $this->citas_model->save_cita($data);
  if ($insert > 0) {
    $dato = 'Correctamente,  Cita para : ' . $fechcit.' '.$horacit;
  } else {
    $dato = 'Fallo!!!';
  }
  echo json_encode(array("status" => $dato));
}

public function ajax_update() {
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
  $result = $this->citas_model->update_cita(array('codecit' => $this->input->post('codcita')), $data);
  if ($result > 0) {
    $dato = 'Correctamente : ' . $this->input->post('codcita'). ', ' . $result . ' Fila (s) Actualizado (s)';
  } else {
    $dato = 'Fallo!!! '.$result;
  }
  echo json_encode(array("status" => $dato));
}

public function ajax_delete_cita($id) {
  $result = $this->citas_model->delete_by_id_cita($id);
  if ($result > 0) {
    $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
  } else {
    $dato = 'Fallo!!! '.$result;
  }
  echo json_encode(array("status" => $dato));
}

public function atender_cita($id) {

  $this->load->model('consulta_model');
  $this->load->model('general_model');
  //codpac,codmed,mtvclt,diagclt,impclt,moneclt,cantclt,descclt,estpgoclt,usucrclt,fecrclt,usumdclt,femdclt,estrgclt
  $datac = $this->citas_model->get_by_id_cita($id);
  $datas = $this->general_model->getServicioUnidad($datac->motcit);
  $dato='';
  $datetimeiniate=gmdate("Y-m-d H:i:s", time() - 18000);
  $data = array(           
   'codempclt'=>$this->session->userdata('codemp'),'citaclt'=>$id,'codpac'=>$datac->codepac,'codmed'=>$datac->codmed,'codesp'=>$datac->codesp,'mtvclt'=>$datac->motcit,'diagclt'=>0,'impclt'=>$datas->pusrv,'moneclt'=>$datas->monsvr,'cantclt'=>1,'descclt'=>'','estpgoclt'=>0,'iniateclt'=>$datetimeiniate,'usucrclt'=>$this->session->userdata('codiper')   
 );
  $insert = $this->consulta_model->save_consulta($data);
  if ($insert > 0) {
    $result = $this->citas_model->update_id_cita($id);
    if ($result > 0) {
    $dato = 'Correctamente,  consulta para atender : '.$result;
  }
  } else {
    $dato = 'Fallo!!!';
  }
  echo json_encode($dato);
}

}

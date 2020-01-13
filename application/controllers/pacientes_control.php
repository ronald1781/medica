<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
               // $this->load->model('news_model');
               // $this->load->helper('url_helper');
	}

	public function index()
	{		
		$valid = $this->session->userdata('validated');
    if ($valid == TRUE) {
			$datos['titulo'] = 'Paciente';
			$datos['contenido'] = 'pacientes_view';
			$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		}
	}
	
	function registrar_paciente()
	{		
		if (($valid == TRUE)&&($result==TRUE)) {
			$datos['titulo'] = 'Paciente Registrar';
			$datos['contenido'] = 'pacienteregistrar_view';
			$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		}
	}


}

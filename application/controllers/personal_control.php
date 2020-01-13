<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
               // $this->load->model('news_model');
               // $this->load->helper('url_helper');
	}

	public function index()
	{		$valid = $this->session->userdata('validated');
    if ($valid == TRUE) {
			$datos['titulo'] = 'Personal';
		$datos['contenido'] = 'personal_view';
		$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		}
	}
	
	function registrar_personal()
	{		
		if (($valid == TRUE)&&($result==TRUE)) {
		$datos['titulo'] = 'personal Registrar';
		$datos['contenido'] = 'parsonalregistrar_view';
		$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		}
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('especialidad_model');
               // $this->load->helper('url_helper');
	}
	public function index()
	{
		
		$valid = $this->session->userdata('validated');
		if ($valid == TRUE) {
			$datos['titulo'] = 'Especialidad';
			$datos['contenido'] = 'especialidad_view';
			$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		} 
	}	



}

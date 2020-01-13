<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_control extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('login_model', '', TRUE);
	}

	public function index($msg = NULL)
	{
		$datos['msg'] = $msg;
		$datos['titulo'] = 'Medical';
		$this->load->view('login_view', $datos);
	}	
	public function process() {
		$EUDSCCOR='';
		$lstcia=array();
		$username = $this->security->xss_clean($this->input->post('txtuser'));
		$password =  md5($this->security->xss_clean($this->input->post('txtpass'))); 
		$result = $this->login_model->validalogin($username, $password);
		$valid = $this->session->userdata('validated'); 
		if (($valid == TRUE)&&($result==TRUE)) {
			redirect('principal','refresh');
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		} 		    
	}

	public function do_logout() {
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	
	


}

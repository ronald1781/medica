<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
               $this->load->model('general_model');
               // $this->load->helper('url_helper');
	}
	public function index()
	{	
		$valid = $this->session->userdata('validated');
		if ($valid == TRUE) {
			$datos['titulo'] = 'Medical';
			$datos['contenido'] = 'principal_view';
			$this->load->view('includes/plantilla', $datos);
		} else {
			$this->session->set_flashdata('message_name', $result);
			redirect('login','refresh');
		} 
	}	
function getEspecialidad() {
        
        $json = array();
        $dato = array();
        $listespecialidad = $this->general_model->getEspecialidad();
        $num = count($listespecialidad);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listespecialidad[$g];
                $codiesp = $cad['codiesp'];
                $nomesp = $cad['nomesp'];
                $dato[] = $codiesp . '#$#' . strtoupper($nomesp);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }
function getMedico() {
        $esp=$this->security->xss_clean($this->input->post('id'));
        $json = array();
        $dato = array();
        $listmedico = $this->general_model->getMedico($esp);
        $num = count($listmedico);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listmedico[$g];
                $codimed = $cad['codimed'];
                $medico = $cad['medico'];
                $dato[] = $codimed . '#$#' . strtoupper($medico);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }
function getPaciente() {        
        $json = array();
        $dato = array();
        $listmedico = $this->general_model->getPaciente();
        $num = count($listmedico);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listmedico[$g];
                $codpte = $cad['codpte'];
                $paciente = $cad['paciente'];
                $dato[] = $codpte . '#$#' . strtoupper($paciente);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }
function getServicio() {
        $esp=$this->security->xss_clean($this->input->post('id'));
        $json = array();
        $dato = array();
        $listservicio = $this->general_model->getServicio($esp);
        $num = count($listservicio);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listservicio[$g];//a.codsrv,a.silgsrv,a.nomsrv
                $codsrv = $cad['codsrv'];
                $silgsrv = $cad['silgsrv'];
                $nomsrv = $cad['nomsrv'];
                $dato[] = $codsrv . '#$#' . strtoupper($nomsrv);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }
   function getEstadoCita() {        
        $json = array();
        $dato = array();
        $listestadocita = $this->general_model->getEstadoCita();
        $num = count($listestadocita);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listestadocita[$g];//,a.
                $cdimlttb = $cad['cdimlttb'];
                $nommlttb = $cad['nommlttb'];
                $dato[] = $cdimlttb . '#$#' . strtoupper($nommlttb);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }


}

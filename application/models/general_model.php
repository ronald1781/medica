
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class general_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}	

function getEspecialidad() {
	$codemp = $this->session->userdata('codemp');
        $this->db->select('a.codiesp,a.nomesp');
        $this->db->from('tbespecialidad a');
        $this->db->where('a.estregesp', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

function getMedico($esp) {
	$codemp = $this->session->userdata('codemp');
        $this->db->select("a.codimed,concat(b.nomper,', ',b.apepper,' ',b.apemper) as medico");
        $this->db->from('tbmedico a');
        $this->db->join('tbpersonal b', 'a.codiper=b.codper');
        $this->db->where('a.codesp', $esp);
        $this->db->where('a.estregmed', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }
function getPaciente() {
	$codemp = $this->session->userdata('codemp');
	$this->db->select("a.codpte,concat(a.nomcpte,', ',a.apeppte,' ',a.apempte) as paciente");
        $this->db->from('tbpaciente a');
        $this->db->where('a.codemppte', $codemp); 
        $this->db->where('a.estrgpte', 'A'); 	 
        $sql = $this->db->get();
        return $sql->result_array();
    }
//SELECT a.codsrv,a.silgsrv,a.nomsrv FROM tbservicio a where a.estsrv='A' and a.empsrv=1 and a.codespe=2
function getServicio($esp) {
	$codemp = $this->session->userdata('codemp');
        $this->db->select("a.codsrv,a.silgsrv,a.nomsrv,a.pusrv");
        $this->db->from('tbservicio a');
        $this->db->where('a.empsrv', $codemp);
        $this->db->where('a.codespe', $esp); 
        $this->db->where('a.estsrv', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }
function getEstadoCita() {
   $this->db->select("a.codmlttb,a.cdimlttb,a.nommlttb,a.sglmlttb");
        $this->db->from('tbmultitabla a');
        $this->db->where('a.codimlttb', 19); 
        $this->db->where('a.estrgmlttb', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    //SELECT a.codsrv,a.codespe,a.silgsrv,a.nomsrv,a.pusrv FROM tbservicio a where a.estsrv='A' and a.codsrv=1 and a.empsrv=1
function getServicioUnidad($serv) {
    $codemp = $this->session->userdata('codemp');
        $this->db->select("a.codsrv,a.codespe,a.silgsrv,a.nomsrv,a.pusrv,a.monsvr");
        $this->db->from('tbservicio a');
        $this->db->where('a.empsrv', $codemp);
        $this->db->where('a.codsrv', $serv); 
        $this->db->where('a.estsrv', 'A');
        $sql = $this->db->get();
        return $sql->row();
    }

}
?>
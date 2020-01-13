
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}
	function validalogin($username, $password) {		
		$perf = '';
		$msg = '';
		$codperf = '';
		$this->db->select('a.codius,a.usuper,a.dscuse,a.emailus,a.prflus,b.nomprf,c.codemp,c.rucemp,c.rsemp,d.flgmnprf,e.nrodocper,e.codcn');
		$this->db->from('tbusuario a');
		$this->db->join('tbperfil b', 'a.prflus = b.codprf');
		$this->db->join('tbempresa c', 'a.codemp = a.codemp','left');
		$this->db->join('tbmenuperfil d', 'a.prflus = d.perfmnprf');        
		$this->db->join('tbpersonal e', 'a.cdpuse = e.codper','left');
		$this->db->where('a.usuper', $username);
		$this->db->where('a.paswus', $password);
		$this->db->where('a.estrgus', 'A');
		$this->db->group_by('a.codius');
		$this->db->limit(1);
		$query = $this->db->get();
		$codperf = $query->row();
		if (count($codperf) > 0) {
			$perf = $codperf->prflus;
			$this->db->select('b.codidmenu,b.parentmen,b.nommen,b.linkmen,b.altmen,b.icomen');
			$this->db->from('tbmenuperfil a');
			$this->db->join('tbmenu b', 'a.mnumnprf=b.codidmenu');                
			$this->db->where('b.codimenu', '1');
			$this->db->where('b.estrgmen', 'A');
			$this->db->where('a.perfmnprf', $perf);
			$consulta = $this->db->get();
			$menu = $consulta->result_array();
			if ($query->num_rows() == 1) {
				$row = $query->row();
				$data = array(
					'menu' => $menu,
					'codiper' => $row->codius,
					'usuaper' => $row->usuper,
					'codemp'=>$row->codemp,
					'nomemp'=>$row->rsemp,
					'correusua' => $row->emailus,
					'nombape' => $row->dscuse,
					'prevper' => $row->prflus,
					'prfper' => $row->nomprf,
					'llavpfmn' => $row->flgmnprf,
					'codloca'=>$row->codcn,
					'validated' => TRUE,
				);
				$this->session->set_userdata($data);
				$msg = TRUE;
			} else {
				$msg = "<font color=red>Comunicarse con el Administrador de sistemas</font>";
			}

		} else {
			$msg = " <font color=red>Invalido Usuario o Password.</font><br /><br />";
		}
		return $msg;

	}




}
?>
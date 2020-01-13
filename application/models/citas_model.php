
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Citas_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }
   //create or replace view vtcita as SELECT a.codecit,a.codeemp,a.codecn,a.codepac,a.codmed,a.codesp,a.estcit,a.motcit,a.odbscit,a.fechcit,a.horacit,b.nrodocpte,concat(b.nomcpte," ",b.apeppte," ",b.apempte) as paciente,concat(e.nomper,",",e.apepper," ",e.apemper) as medico,d.nomesp,f.nommlttb,g.nomsrv FROM tbcita a inner join tbpaciente b on a.codepac=b.codpte inner join tbmedico c on a.codmed=c.codimed inner join tbespecialidad d on a.codesp=d.codiesp inner join tbpersonal e on c.codiper=e.codper inner join tbmultitabla f on a.estcit=f.cdimlttb inner join tbservicio g on a.motcit=g.codsrv where a.estrgcit='A' and f.codimlttb='19'
//codecit,codeemp,codecn,codepac,codepac,codmed,codesp,motcit,odbscit,ordencit,fechcit,horacit,estcit,usucrcit,fecrcit,usumdcit,fecmdcit,estrgcit

    var $table = 'tbcita';   
    var $colum = array('codecit','codeemp','codecn','codepac','codepac','codmed','codesp','motcit','odbscit','ordencit','fechcit','horacit','estcit','usucrcit','fecrcit','usumdcit','fecmdcit','estrgcit');
    var $order = array('codecit' => 'desc');
    var $vtable = 'vtcita';
    var $vcolum = array('codecit','codesp','nomsrv','odbscit','fechcit','horacit','nrodocpte','paciente','medico','nomesp','nommlttb','estcit');
    var $vorder = array('codecit' => 'desc');
    private function _get_datatables_query_cita($data) {
        $selespe=$data['selespe'];
        $selmedi=$data['selmedi'];
        $selesta=$data['selesta'];
        $codemp = $this->session->userdata('codemp');
        $this->db->from($this->vtable);
        $this->db->where('codeemp', $codemp);
        if(($selespe>0)){
            $this->db->where('codesp', $selespe);
        }else{
        }
        if(($selmedi>0)){
            $this->db->where('codmed', $selmedi);
        }else{
        }
        if(($selesta!='')){
            $this->db->where('estcit', $selesta);
        }else{
        }
       $this->db->where('fechcit>=', $data['fechadesde']);
        $this->db->where('fechcit<=', $data['fechahasta']);     
                $i = 0;
        foreach ($this->vcolum as $item) {
            if ($_POST['search']['value'])
                ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $vcolumn[$i] = $item;
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($vcolumn[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->vorder)) {
            $order = $this->vorder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables_cita($data) {
        $this->_get_datatables_query_cita($data);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_cita($data) {
        $this->_get_datatables_query_cita($data);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_cita($data) {
        $selespe=$data['selespe'];
        $selmedi=$data['selmedi'];        
        $selesta=$data['selesta'];
        $codemp = $this->session->userdata('codemp');
        $this->db->from($this->vtable);
        $this->db->where('codeemp', $codemp);
        if(($selespe>0)){
            $this->db->where('codesp', $selespe);
        }else{
        }
        if(($selmedi>0)){
            $this->db->where('codmed', $selmedi);
        }else{
        }
        if(($selesta!='')){
            $this->db->where('estcit', $selesta);
        }else{
        }
        $this->db->where('fechcit>=', $data['fechadesde']);
        $this->db->where('fechcit<=', $data['fechahasta']);
        return $this->db->count_all_results();
    }
    public function get_by_id_cita($id) {
    	$codemp = $this->session->userdata('codemp');
        $this->db->from($this->table);
        $this->db->where('codeemp', $codemp);
        $this->db->where('codecit', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function save_cita($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function update_cita($where, $data) {
    	$codemp = $this->session->userdata('codemp');
       $this->db->where('codeemp', $codemp);
       $this->db->update($this->table, $data, $where);
       return $this->db->affected_rows();
   }
   public function delete_by_id_cita($id) {
       $codemp = $this->session->userdata('codemp');
       $this->db->set('estcit', 'I');
       $this->db->set('estrgcit', 'I');
       $this->db->where('codeemp', $codemp);
       $this->db->where('estrgcit', 'A');
       $this->db->where('codecit', $id);
       $this->db->update($this->table);
       return $this->db->affected_rows();
   }
public function update_id_cita($id) {
       $codemp = $this->session->userdata('codemp');
       $this->db->set('estcit', 'A');
       $this->db->set('usumdcit', $this->session->userdata('codiper'));
       $this->db->set('fecmdcit', gmdate("Y-m-d H:i:s", time() - 18000));
       $this->db->where('codeemp', $codemp);
       $this->db->where('estrgcit', 'A');
       $this->db->where('codecit', $id);       
       $this->db->update($this->table);
       return $this->db->affected_rows();
   }

}
?>
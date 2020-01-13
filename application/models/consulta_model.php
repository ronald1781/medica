
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Consulta_model extends CI_Model
{

public function __construct() {
        parent::__construct();
    }  
  //create or replace view vtconsulta as SELECT a.codclt,a.codempclt,a.citaclt,a.codpac,a.codesp,a.codmed,a.mtvclt,a.diagclt,a.impclt,a.moneclt,a.cantclt,a.descclt,a.estpgoclt,iniateclt,finateclt,concat(b.nomcpte," ",b.apeppte," ",b.apempte) as paciente,concat(e.nomper,",",e.apepper," ",e.apemper) as medico, d.nomesp,g.nomsrv,f.sglmlttb as smbmone FROM tbconsulta a inner join tbpaciente b on a.codpac=b.codpte inner join tbmedico c on a.codmed=c.codimed inner join tbespecialidad d on a.codspclt=d.codiesp inner join tbpersonal e on c.codiper=e.codper inner join tbservicio g on a.mtvclt=g.codsrv inner join tbmultitabla f on a.moneclt=f.cdimlttb where a.estrgclt='A' and f.codimlttb='24' 

    //a.codclt,a.citaclt,a.codpac,a.codmed,a.mtvclt,a.diagclt,a.impclt,a.moneclt,a.cantclt,a.descclt,a.estpgoclt,iniateclt,finateclt,paciente,medico, d.nomesp,g.nomsrv
    //codpac,codmed,mtvclt,diagclt,impclt,moneclt,cantclt,descclt,estpgoclt,usucrclt,fecrclt,usumdclt,femdclt,estrgclt

    var $table = 'tbconsulta';   
    var $colum = array('codclt','citaclt','codpac','codesp','codmed','mtvclt','diagclt','impclt','moneclt','cantclt','descclt','estpgoclt','iniateclt','finateclt','usucrclt','fecrclt','usumdclt','femdclt','estrgclt');
    var $order = array('codclt' => 'desc');
     var $vtable = 'vtconsulta';
    var $vcolum = array('codclt','citaclt','codpac','codesp','codmed','mtvclt','diagclt','impclt','moneclt','cantclt','descclt','estpgoclt','iniateclt','finateclt','paciente','medico', 'nomesp','nomsrv','smbmone');
    var $vorder = array('codclt' => 'desc');
    private function _get_datatables_query_consulta($data) {
    	$selespe=$data['selespe'];
        $selmedi=$data['selmedi'];
        $selpacis=$data['selpacis'];
    	$codemp = $this->session->userdata('codemp');
        $this->db->from($this->vtable);
        $this->db->where('codempclt', $codemp);
        if(($selespe>0)){
            $this->db->where('codesp', $selespe);
        }else{
        }
        if(($selmedi>0)){
            $this->db->where('codmed', $selmedi);
        }else{
        }
        if(($selpacis!='')){
            $this->db->where('codpac', $selpacis);
        }else{
        }
       $this->db->where('iniateclt>=', $data['fechadesde']);
        $this->db->where('iniateclt<=', $data['fechahasta']); 
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
    function get_datatables_consulta($data) {
        $this->_get_datatables_query_consulta($data);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_consulta($data) {
        $this->_get_datatables_query_consulta($data);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_consulta($data) {
    	$selespe=$data['selespe'];
        $selmedi=$data['selmedi'];        
        $selpacis=$data['selpacis'];
    	$codemp = $this->session->userdata('codemp');
        $this->db->from($this->vtable);
        $this->db->where('codempclt', $codemp);
         if(($selespe>0)){
            $this->db->where('codesp', $selespe);
        }else{
        }
        if(($selmedi>0)){
            $this->db->where('codmed', $selmedi);
        }else{
        }
        if(($selpacis!='')){
            $this->db->where('codpac', $selpacis);
        }else{
        }
        $this->db->where('iniateclt>=', $data['fechadesde'].'00:00:00');
        $this->db->where('iniateclt<=', $data['fechahasta'].'23:59:59');
        return $this->db->count_all_results();
    }
    public function get_by_id_consulta($id) {
    	$codemp = $this->session->userdata('codemp');
        $this->db->from($this->vtable);
       $this->db->where('codempclt', $codemp);
        $this->db->where('codclt', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function save_consulta($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function update_consulta($where, $data) {
    	$codemp = $this->session->userdata('codemp');
         $this->db->where('codempclt', $codemp);
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete_by_id_cosulta($id) {
    	$codemp = $this->session->userdata('codemp');
         $this->db->set('estcit', 'I');
        $this->db->set('estrgcit', 'I');
        $this->db->where('codempclt', $codemp);
        $this->db->where('estrgcit', 'A');
        $this->db->where('codclt', $id);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    

}
?>
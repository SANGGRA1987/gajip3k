<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_otorisasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('utilitas/M_otorisasi');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
        $sql = $this->db->query("SELECT cad from config")->row();
		$data['page'] 			= "Otorisasi";
		$data['judul'] 			= "Master Otorisasi";
		$data['deskripsi'] 		= "Otorisasi";
		$data['mode'] 			= $sql->cad;
		$this->template->views('utilitas/V_otorisasi', $data);
	}
	
	function load_otorisasi() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY idmenu ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "and upper(judul) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from ms_menu where is_active<>'0' $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT idmenu,judul,case WHEN m01='1' then 'YA' else 'TIDAK' end as m01,
				case WHEN m02='1' then 'YA' else 'TIDAK' end as m02,
				case WHEN m03='1' then 'YA' else 'TIDAK' end as m03,is_parent 
				FROM ms_menu where is_active<>'0' 
				and is_parent not in ('100','110','120','1100') and idmenu<>'1' $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'is_parent' => $resulte['is_parent'],
                        'idmenu' => $resulte['idmenu'],
                        'judul' => $resulte['judul'],
                        'm01' => $resulte['m01'],
                        'm02' => $resulte['m02'],
                        'm03' => $resulte['m03']					
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}

	
	public function simpan(){
		$id 	= $this->input->post('id');
		$m1 	= $this->input->post('adm');
		$m2 	= $this->input->post('oper1');
		$m3 	= $this->input->post('oper2');

		if($m1=='YA'){
			$m01 = '1';
		}else{
			$m01 = '0';
		}
		if($m2=='YA'){
			$m02 = '1';
		}else{
			$m02 = '0';
		}
		if($m3=='YA'){
			$m03 = '1';
		}else{
			$m03 = '0';
		}
			
		$sukses = $this->M_otorisasi->simpan($id,$m01,$m02,$m03);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function conn_smkd(){
		$id 	= $this->input->post('id');
		$sukses = $this->M_otorisasi->conn_smkd($id);
	}
	
    function yatidak1() {
		$result[] = array('m01' => 'YA');
		$result[] = array('m01' => 'TIDAK');                       
        echo json_encode($result);    	   
	}

 	function yatidak2() {
		$result[] = array('m02' => 'YA');
		$result[] = array('m02' => 'TIDAK');                       	
        echo json_encode($result);
	}

 	function yatidak3() {
		$result[] = array('m03' => 'YA');
		$result[] = array('m03' => 'TIDAK');                       
        echo json_encode($result);
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_unitskpd extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('master/M_unitskpd');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page'] 			= "UNITKERJA";
		$data['judul'] 			= "Master Tabel UNITKERJA";
		$data['deskripsi'] 		= "SATKERJA";
		$this->template->views('master/V_unitskpd', $data);
	}
	
	function load_unit() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY unitkerja ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(unit) like upper('%$key%') or upper(nm_unit) like upper('%$key%') or upper(kota) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from unitkerja $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT * from unitkerja $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'satkerja' => $resulte['satkerja'],
                        'unit' => $resulte['unit'],
                        'nm_unit' => $resulte['nm_unit'],
                        'kota' => $resulte['kota'],
                        'jab_atasan' => $resulte['jab_atasan'],
                        'jab_atasan2' => $resulte['jab_atasan2'],
                        'nama_atasan' => $resulte['nama_atasan'],
                        'nip_atasan' => $resulte['nip_atasan'],
                        'jab_bend' => $resulte['jab_bend'],
                        'nama_bend' => $resulte['nama_bend'],
                        'nip_bend' => $resulte['nip_bend'],
                        'jab_operator' => $resulte['jab_operator'],
                        'nama_operator' => $resulte['nama_operator'],
                        'nip_operator' => $resulte['nip_operator']	
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}
	
	public function simpan(){
		$param  = $this->input->post();
		$sukses = $this->M_unitskpd->simpan($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_unitskpd->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_unitskpd->hapus($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else{
				echo json_encode(array('pesan'=>false));
			}
	}
	
	function max_number(){
        $table = $this->input->post('table');
        $kolom = $this->input->post('kolom');
        $query1 = $this->db->query("SELECT MAX($kolom) AS kode FROM $table");  
        $result = array();
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(      
                        'no_urut' => $resulte['kode']
                        );
        }
        echo json_encode($result);
	}
	
	
}

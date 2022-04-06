<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_fungsional extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('master/M_fungsional');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page'] 			= "Fungsional";
		$data['judul'] 			= "Master Fungsional";
		$data['deskripsi'] 		= "Fungsional";
		$this->template->views('master/V_Fungsional', $data);
	}
	
	function load_fungsional() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY kd_fung ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(kd_fung) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from fungsional $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT * from fungsional $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'kd_fung' => $resulte['kd_fung'],
                        'golongan' => $resulte['golongan'],
                        'jumlah' => number_format($resulte['jumlah'],2,'.',','),
                        'ket' => $resulte['ket']							
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}
	
	public function simpan(){
		$param  = $this->input->post();
		$sukses = $this->M_fungsional->simpan($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_fungsional->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_fungsional->hapus($param);
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ttd extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('master/M_ttd');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page'] 			= "Penandatangan";
		$data['judul'] 			= "Master Tabel Penandatangan";
		$data['deskripsi'] 		= "SATKERJA";
		$this->template->views('master/V_ttd', $data);
	}
	
	function load_unit() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY nama ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(nip) like upper('%$key%') or upper(nama) like upper('%$key%') ";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from ttd $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT * from ttd $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'skpd' => $resulte['skpd'],
                        'nm_skpd' => $resulte['nm_skpd'],
                        'unit' => $resulte['unit'],
                        'nm_unit' => $resulte['nm_unit'],
                        'jabatan' => $resulte['jabatan'],
                        'nama' => $resulte['nama'],
                        'nip' => $resulte['nip'],
                        'ckey' => $resulte['ckey']
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}
	
	public function simpan(){
		$param  = $this->input->post();
		$sukses = $this->M_ttd->simpan($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_ttd->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_ttd->hapus($param);
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
	
	public function get_kode()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_ttd->get_kode($lccq);
		echo json_encode($res);
	}
	
}

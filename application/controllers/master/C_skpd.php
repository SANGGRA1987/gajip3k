<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_skpd extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('master/M_skpd');
		$this->load->library('form_validation');        
        $this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page'] 			= "SATKERJA";
		$data['judul'] 			= "Master Tabel SATUAN KERJA";
		$data['deskripsi'] 		= "SATKERJA";
		$this->template->views('master/V_skpd', $data);
	}
	
	function load_skpd() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY satkerja ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(satkerja) like upper('%$key%') or upper(nm_satkerja) like upper('%$key%') or upper(kota) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from satkerja $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT * from satkerja $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'satkerja' => $resulte['satkerja'],
                        'nm_satkerja' => $resulte['nm_satkerja'],
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
                        'nip_operator' => $resulte['nip_operator'],
                        'pasal1' => $resulte['pasal1'],
                        'pasal2' => $resulte['pasal2'],
                        'pasal3' => $resulte['pasal3'],
                        'pasal4' => $resulte['pasal4'],
                        'pasal5' => $resulte['pasal5'],
                        'pasal6' => $resulte['pasal6'],
                        'pasal7' => $resulte['pasal7'],
                        'pasal8' => $resulte['pasal8'],
                        'pasal9' => $resulte['pasal9'],
                        'pasal10' => $resulte['pasal10'],
                        'pasal11' => $resulte['pasal11'],
                        'ayat1' => $resulte['ayat1'],
                        'ayat2' => $resulte['ayat2'],
                        'ayat3' => $resulte['ayat3'],
                        'ayat4' => $resulte['ayat4'],
                        'ayat5' => $resulte['ayat5'],
                        'ayat6' => $resulte['ayat6'],
                        'ayat7' => $resulte['ayat7'],
                        'jab_bend2' => $resulte['jab_bend2'],
                        'nama_bend2' => $resulte['nama_bend2'],
                        'nip_bend2' => $resulte['nip_bend2'],
                        'rekening' => $resulte['rekening'],
                        'alamat' => $resulte['alamat'],
                        'no_dpa' => $resulte['no_dpa']		
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}
	
	public function simpan(){
		$param  = $this->input->post();
		$sukses = $this->M_skpd->simpan($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_skpd->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_skpd->hapus($param);
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

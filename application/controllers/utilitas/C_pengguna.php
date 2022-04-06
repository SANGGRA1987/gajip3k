<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pengguna extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('utilitas/M_pengguna');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['page'] 			= "Pengguna SIMGAJI";
		$data['judul'] 			= "Master Tabel Pengguna SIMGAJI";
		$data['deskripsi'] 		= "Pengguna SIMGAJI";
		$this->template->views('utilitas/V_pengguna', $data);
	}
	
	function load_pengguna() {
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$where = '';
		$limit = "ORDER BY oto ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$where = "where upper(nm_user) like upper('%$key%')";	
		$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from muser $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT kode,case 
				when oto='01' then 'Administrator'
				when oto='02' then 'Operator 1'
				else 'Operator 2' end as oto,nm_user,
				email_user from muser $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'kode' => $resulte['kode'],
                        'oto' => $resulte['oto'],
                        'nm_user' => $resulte['nm_user'],
                        'email_user' => $resulte['email_user']					
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
    	   
	}
	
	public function getSkpd()
	{
		echo $this->M_pengguna->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$skpd = $this->input->post('skpd');
		echo $this->M_pengguna->getUnitSkpd($skpd);
	}
	
	public function simpan(){
		if($this->input->post('otori')=='01'){
			$nm_user= $this->input->post('nmuser');
		}else{
			$nm_user= $this->input->post('nmskpd');
		}
		$data   = array(
			'kode'		=> $this->input->post('kode'),
			'username'	=> $this->input->post('user'),
			'password'	=> md5($this->input->post('pass')),
			'oto'		=> $this->input->post('otori'),
			'kd_skpd'	=> $this->input->post('skpd'),
			'kd_unit'	=> $this->input->post('uskpd'),
			'nm_user'	=> $nm_user,
			'email_user'=> $this->input->post('email'),
			'cad'		=> ''
		
		
		);
	
		$sukses = $this->M_pengguna->simpan($data);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_pengguna->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_pengguna->hapus($param);
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Keluarga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_Keluarga');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Data Keluarga Pegawai ",
			'judul'		=> "Data Keluarga Pegawai ",
			'deskripsi'	=> "Data Keluarga Pegawai "
		);

		$this->template->views('master/V_Keluarga', $data);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Tambah Keluarga",
			'judul'		=> "Tambah Keluarga",
			'deskripsi'	=> "Tambah Keluarga"
		);
		$this->template->views('master/V_Add_Keluarga', $data);
	}
	
	public function getJenis()
	{
		$data = array(
			'kd' 	=> $this->input->post('kel'),
			'lccq' 	=> $this->input->post('q')
		);
		$res = $this->M_Keluarga->getJenis($data);
		echo json_encode($res);
	}
	
	

	public function getBarang()
	{
		$data = array(
			'kd' 	=> $this->input->post('kod'),
			'lccq' 	=> $this->input->post('q')
		);

		$result = $this->M_Keluarga->getBarang($data);

		echo json_encode($result);
	}

	public function getNIP()
	{
		$result = $this->M_Keluarga->getNIP();
		echo json_encode($result);
	}

	public function getHub()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Keluarga->getHub($lccq);
		echo json_encode($res);
	}

	public function saveData(){
		$nip		= $this->input->post('nip');
		$status  	= $this->input->post('status');
		$data 		= json_decode($this->input->post('detail'));
		
		$header = array(
				'nip' 		=> htmlspecialchars($nip, ENT_QUOTES)
		);
		
		//$h =	$this->M_Keluarga->simpan_header($header,$status,$nip);
		//if($h == 1 ){
			$sukses =	$this->M_Keluarga->simpan_detail($data,$nip,$status);
				if($sukses){
                	echo json_encode(array('notif'=>true,'message'=>'Data Berhasil Disimpan !'));
				}else {
                	echo json_encode(array('notif'=>false,'message'=>'Data Gagal Disimpan !'));
				}
		//}else{
        //            	echo json_encode(array('notif'=>false,'message'=>'Nomor Dokumen Sudah ada, Mohon dicek kemali !'));
		//}
	}
	
	public function ubah(){
		$param  = $this->input->post();
		$sukses = $this->M_Perusahaan->ubah($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else {
				echo json_encode(array('pesan'=>false));
			}
	}
	
	public function hapus(){
	
		$param  = $this->input->post();
		$sukses = $this->M_Keluarga->hapus($param);
			if($sukses){
				echo json_encode(array('pesan'=>true));
			}else{
				echo json_encode(array('pesan'=>false));
			}
	}

	function trd_keluarga(){
        $data = array(
        	'nip' 		=> $this->input->post('nip')
    	);

    	$res = $this->M_Keluarga->load_keluarga($data);
    	echo json_encode($res);
    }

    function load_header()
	{
        $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
        $key = $this->input->post('key');
		$and2 = '';
		$limit = "ORDER BY a.nama ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
		$and2 = "where upper(a.nama) like upper('%$key%') or upper(a.nip) like upper('%$key%')";	
		$limit = "";	
		}

		$sql = "SELECT count(a.*) as tot from public.pegawai a where a.nip in (select nip from ms_keluarga GROUP BY nip) 
				and (upper(a.nama) like upper('%$key%') or upper(a.nip) like upper('%$key%'))" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql2 = "SELECT a.nip,a.nama,a.anak from public.pegawai a INNER JOIN ms_keluarga b on a.nip=b.nip $and2 GROUP BY a.nip,a.nama,a.anak $limit";
        $query2 = $this->db->query($sql2);  
        $result = array();
        $ii = 0;
        foreach($query2->result_array() as $resulte)
        { 
            $row[] = array(
                'id'=> $ii,        
                'nip' 	=> $resulte['nip'],
                'nama' 	=> $resulte['nama'],
                'anak' 	=> $resulte['anak'],
            );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        echo json_encode($result);
	}

}

/* End of file C_Pengadaan.php */
/* Location: ./application/controllers/perencanaan/C_Pengadaan.php */
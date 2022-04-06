<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_transfer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_transfer');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "DAFTAR TRANSFER SP2D GAJI KE SIMAKDA",
			'judul'		=> "DAFTAR TRANSFER SP2D GAJI KE SIMAKDA",
			'deskripsi'	=> "DAFTAR TRANSFER SP2D GAJI KE SIMAKDA"
		);

		$this->template->views('utilitas/V_transfer', $data);
	}


	function load_header(){
		$key = $this->input->post('key');
		$res = $this->M_transfer->loadHeader($key);
    	echo json_encode($res);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "RINCIAN TRANSFER SP2D GAJI",
			'judul'		=> "RINCIAN TRANSFER SP2D GAJI",
			'deskripsi'	=> "RINCIAN TRANSFER SP2D GAJI"
		);

		$this->template->views('utilitas/V_Add_transfer', $data);
	}

	public function saveData(){
		
		$no_kirim    = $this->input->post('no_kirim');
		$tanggal   	 = $this->input->post('tanggal');
		$bulan   	 = $this->input->post('bulan');
		$data        = json_decode($this->input->post('detail'));
		$status      = $this->input->post('status');
		$total   	 = $this->input->post('total');
		
		$header = array(
				'no_kirim' => htmlspecialchars($no_kirim, ENT_QUOTES),
				'tanggal'  	=> htmlspecialchars($tanggal, ENT_QUOTES),
				'bulan'  	=> htmlspecialchars($bulan, ENT_QUOTES),
				'total'  	=> str_replace(array(',',''), array('',''), $total)
		);
		
		$h =	$this->M_transfer->saveData($header,$status);
		if($h == 1){
				$sukses =	$this->M_transfer->simpan_detail($no_kirim,$status,$data);
					if($sukses){
						echo json_encode(array('notif'=>true,'message'=>'Data Berhasil Disimpan !'));
					}else {
						echo json_encode(array('notif'=>false,'message'=>'Data Gagal Disimpan !'));
					}
		}else{
			echo json_encode(array('notif'=>false,'message'=>'Nomor SPM Sudah ada, Mohon dicek kembali !'));
		}
	}

	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_transfer->hapus($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}

	function load_detail(){
        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
    	);

    	$res = $this->M_transfer->load_detail($data);
    	echo json_encode($res);
    }

    function ambil_total(){
		$no_kirim  = $this->input->post('no_kirim');
		$res     = $this->M_transfer->ambil_total($no_kirim);
    	echo json_encode($res);
	}

	function ambil_sp2d_advis(){
        $data = array(
        	'nomor'		=> $this->input->post('no'), 
        	'bulan'		=> $this->input->post('bln'), 
    	);

    	$res = $this->M_transfer->ambil_sp2d_advis($data);
    	echo json_encode($res);
    }

    public function bulan()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_transfer->bulan($lccq);
		echo json_encode($res);
	}


}
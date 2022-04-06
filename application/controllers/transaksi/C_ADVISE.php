<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ADVISE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_ADVISE');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Daftar ADVIS",
			'judul'		=> "Daftar ADVIS",
			'deskripsi'	=> "Daftar ADVIS"
		);

		$this->template->views('transaksi/dokumen/V_ADVISE', $data);
	}


	function load_header(){
		$key = $this->input->post('key');
		$res = $this->M_ADVISE->loadHeader($key);
    	echo json_encode($res);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Rincian ADVIS",
			'judul'		=> "Rincian ADVIS",
			'deskripsi'	=> "Rincian ADVIS"
		);

		$this->template->views('transaksi/dokumen/V_Add_ADVISE', $data);
	}

	public function saveData(){
		
		$no_advise   = $this->input->post('no_advise');
		$tanggal   	 = $this->input->post('tanggal');
		$data        = json_decode($this->input->post('detail'));
		$status      = $this->input->post('status');
		$total   	 = $this->input->post('total');
		
		$header = array(
				'no_advise' => htmlspecialchars($no_advise, ENT_QUOTES),
				'tanggal'  	=> htmlspecialchars($tanggal, ENT_QUOTES),
				'total'  	=> str_replace(array(',',''), array('',''), $total)
		);
		
		$h =	$this->M_ADVISE->saveData($header,$status);
		if($h == 1){
				$sukses =	$this->M_ADVISE->simpan_detail($no_advise,$status,$data);
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
		$sukses = $this->M_ADVISE->hapus($param);
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

    	$res = $this->M_ADVISE->load_detail($data);
    	echo json_encode($res);
    }

    function ambil_total(){
		$no_advise  = $this->input->post('no_advise');
		$res     = $this->M_ADVISE->ambil_total($no_advise);
    	echo json_encode($res);
	}

	function ambil_sp2d_advis(){
        $data = array(
        	'nomor'		=> $this->input->post('no'), 
    	);

    	$res = $this->M_ADVISE->ambil_sp2d_advis($data);
    	echo json_encode($res);
    }



}
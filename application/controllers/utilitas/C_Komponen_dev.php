<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Komponen_dev extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_Komponen_dev');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Komponen Perhitungan Gaji",
			'judul'		=> "Komponen Perhitungan Gaji",
			'deskripsi'	=> "Komponen Perhitungan Gaji"
		);

		$this->template->views('utilitas/V_Komponen_dev', $data);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Komponen Perhitungan Gaji",
			'judul'		=> "Komponen Perhitungan Gaji",
			'deskripsi'	=> "Komponen Perhitungan Gaji"
		);
		$this->template->views('utilitas/V_Add_Komponen_dev', $data);
	}

	function load_header(){
		$res = $this->M_Komponen_dev->load_header();
    	echo json_encode($res);
	}
	
	public function simpan(){	 				
			$beras_kg 	= $this->input->post('beras_kg');
			$beras_rp 	= $this->input->post('beras_rp');
			$iwp 		= $this->input->post('iwp');
			$potpens 	= $this->input->post('potpens');
			$tht 		= $this->input->post('tht');
			$ptkp 		= $this->input->post('ptkp');
			$askes 		= $this->input->post('askes');
			$ptkp2 		= $this->input->post('ptkp2');
			$jkk 		= $this->input->post('jkk');
			$jkm 		= $this->input->post('jkm');
			$istri 		= $this->input->post('istri');
			$anak 		= $this->input->post('anak');

		$header 	= array(				 
			'beras_kg' 	=> str_replace(array(',',''), array('',''), $beras_kg),
			'beras_rp' 	=> str_replace(array(',',''), array('',''), $beras_rp),
			'iwp' 		=> str_replace(array(',',''), array('',''), $iwp),
			'potpens' 	=> str_replace(array(',',''), array('',''), $potpens),
			'tht' 		=> str_replace(array(',',''), array('',''), $tht),
			'ptkp' 		=> str_replace(array(',',''), array('',''), $ptkp),
			'askes' 	=> str_replace(array(',',''), array('',''), $askes),
			'ptkp2' 	=> str_replace(array(',',''), array('',''), $ptkp2),
			'jkk' 		=> str_replace(array(',',''), array('',''), $jkk),
			'jkm' 		=> str_replace(array(',',''), array('',''), $jkm),
			'istri' 	=> str_replace(array(',',''), array('',''), $istri),
			'anak' 		=> str_replace(array(',',''), array('',''), $anak)
		);
		
		$simpan = $this->M_Komponen_dev->saveData($header);			
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		
		
	}
	
	

}
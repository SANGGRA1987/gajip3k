<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Komponen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_Komponen');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Komponen Perhitungan Gaji",
			'judul'		=> "Komponen Perhitungan Gaji",
			'deskripsi'	=> "Komponen Perhitungan Gaji"
		);

		$this->template->views('utilitas/V_Komponen', $data);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "Komponen Perhitungan Gaji",
			'judul'		=> "Komponen Perhitungan Gaji",
			'deskripsi'	=> "Komponen Perhitungan Gaji"
		);
		$this->template->views('utilitas/V_Add_Komponen', $data);
	}

	function load_header(){
		$res = $this->M_Komponen->load_header();
    	echo json_encode($res);
	}
	
	public function simpan(){	 				
			$cpns1 		= $this->input->post('cpns1');
			$cpns2 		= $this->input->post('cpns2');
			$cpns3 		= $this->input->post('cpns3');
			$cpns4 		= $this->input->post('cpns4');
			$istri1 	= $this->input->post('istri1');
			$istri2 	= $this->input->post('istri2');
			$istri3 	= $this->input->post('istri3');
			$istri4 	= $this->input->post('istri4');
			$anak1 		= $this->input->post('anak1');
			$anak2 		= $this->input->post('anak2');
			$anak3 		= $this->input->post('anak3');
			$anak4 		= $this->input->post('anak4');
			$tpp1 		= $this->input->post('tpp1');
			$tpp2 		= $this->input->post('tpp2');
			$tpp3 		= $this->input->post('tpp3');
			$tpp4 		= $this->input->post('tpp4');
			$beras_kg1 	= $this->input->post('beras_kg1');
			$beras_kg2 	= $this->input->post('beras_kg2');
			$beras_kg3 	= $this->input->post('beras_kg3');
			$beras_kg4 	= $this->input->post('beras_kg4');
			$beras_rp1 	= $this->input->post('beras_rp1');
			$beras_rp2 	= $this->input->post('beras_rp2');
			$beras_rp3 	= $this->input->post('beras_rp3');
			$beras_rp4 	= $this->input->post('beras_rp4');
			$tdt1 		= $this->input->post('tdt1');
			$tdt2 		= $this->input->post('tdt2');
			$tdt3 		= $this->input->post('tdt3');
			$tdt4 		= $this->input->post('tdt4');
			$tirja1 	= $this->input->post('tirja1');
			$tirja2 	= $this->input->post('tirja2');
			$tirja3 	= $this->input->post('tirja3');
			$tirja4 	= $this->input->post('tirja4');
			$lain1 		= $this->input->post('lain1');
			$lain2 		= $this->input->post('lain2');
			$lain3 		= $this->input->post('lain3');
			$lain4 		= $this->input->post('lain4');
			$askes1 	= $this->input->post('askes1');
			$askes2 	= $this->input->post('askes2');
			$askes3 	= $this->input->post('askes3');
			$askes4 	= $this->input->post('askes4');
			$tirja11 	= $this->input->post('tirja11');
			$tirja12 	= $this->input->post('tirja12');
			$tirja13 	= $this->input->post('tirja13');
			$tirja14 	= $this->input->post('tirja14');
			$tirja21 	= $this->input->post('tirja21');
			$tirja22 	= $this->input->post('tirja22');
			$tirja23 	= $this->input->post('tirja23');
			$tirja24 	= $this->input->post('tirja24');
			$tirja31 	= $this->input->post('tirja31');
			$tirja32 	= $this->input->post('tirja32');
			$tirja33 	= $this->input->post('tirja33');
			$tirja34 	= $this->input->post('tirja34');
			$tirja41 	= $this->input->post('tirja41');
			$tirja42 	= $this->input->post('tirja42');
			$tirja43 	= $this->input->post('tirja43');
			$tirja44 	= $this->input->post('tirja44');
			$tirja45 	= $this->input->post('tirja45');
			$iwp1 		= $this->input->post('iwp1');
			$iwp2 		= $this->input->post('iwp2');
			$iwp3 		= $this->input->post('iwp3');
			$iwp4 		= $this->input->post('iwp4');
			$korpri1 	= $this->input->post('korpri1');
			$korpri2 	= $this->input->post('korpri2');
			$korpri3 	= $this->input->post('korpri3');
			$korpri4 	= $this->input->post('korpri4');
			$tabrumah1 	= $this->input->post('tabrumah1');
			$tabrumah2 	= $this->input->post('tabrumah2');
			$tabrumah3 	= $this->input->post('tabrumah3');
			$tabrumah4 	= $this->input->post('tabrumah4');
			$potjab1 	= $this->input->post('potjab1');
			$potjab2 	= $this->input->post('potjab2');
			$potjab3 	= $this->input->post('potjab3');
			$potjab4 	= $this->input->post('potjab4');
			$potpens1 	= $this->input->post('potpens1');
			$potpens2 	= $this->input->post('potpens2');
			$potpens3 	= $this->input->post('potpens3');
			$potpens4 	= $this->input->post('potpens4');
			$tht1 		= $this->input->post('tht1');
			$tht2 		= $this->input->post('tht2');
			$tht3 		= $this->input->post('tht3');
			$tht4 		= $this->input->post('tht4');
			$ptkp 		= $this->input->post('ptkp');
			$ptkp2 		= $this->input->post('ptkp2');

		$header 	= array(				 
			'cpns1' 		=> str_replace(array(',',''), array('',''), $cpns1),
			'cpns2' 		=> str_replace(array(',',''), array('',''), $cpns2),
			'cpns3' 		=> str_replace(array(',',''), array('',''), $cpns3),
			'cpns4' 		=> str_replace(array(',',''), array('',''), $cpns4),
			'istri1' 	=> str_replace(array(',',''), array('',''), $istri1),
			'istri2' 	=> str_replace(array(',',''), array('',''), $istri2),
			'istri3' 	=> str_replace(array(',',''), array('',''), $istri3),
			'istri4' 	=> str_replace(array(',',''), array('',''), $istri4),
			'anak1' 		=> str_replace(array(',',''), array('',''), $anak1),
			'anak2' 		=> str_replace(array(',',''), array('',''), $anak2),
			'anak3' 		=> str_replace(array(',',''), array('',''), $anak3),
			'anak4' 		=> str_replace(array(',',''), array('',''), $anak4),
			'tpp1' 		=> str_replace(array(',',''), array('',''), $tpp1),
			'tpp2' 		=> str_replace(array(',',''), array('',''), $tpp2),
			'tpp3' 		=> str_replace(array(',',''), array('',''), $tpp3),
			'tpp4' 		=> str_replace(array(',',''), array('',''), $tpp4),
			'beras_kg1' 	=> str_replace(array(',',''), array('',''), $beras_kg1),
			'beras_kg2' 	=> str_replace(array(',',''), array('',''), $beras_kg2),
			'beras_kg3' 	=> str_replace(array(',',''), array('',''), $beras_kg3),
			'beras_kg4' 	=> str_replace(array(',',''), array('',''), $beras_kg4),
			'beras_rp1' 	=> str_replace(array(',',''), array('',''), $beras_rp1),
			'beras_rp2' 	=> str_replace(array(',',''), array('',''), $beras_rp2),
			'beras_rp3' 	=> str_replace(array(',',''), array('',''), $beras_rp3),
			'beras_rp4' 	=> str_replace(array(',',''), array('',''), $beras_rp4),
			'tdt1' 		=> str_replace(array(',',''), array('',''), $tdt1),
			'tdt2' 		=> str_replace(array(',',''), array('',''), $tdt2),
			'tdt3' 		=> str_replace(array(',',''), array('',''), $tdt3),
			'tdt4' 		=> str_replace(array(',',''), array('',''), $tdt4),
			'tirja1' 	=> str_replace(array(',',''), array('',''), $tirja1),
			'tirja2' 	=> str_replace(array(',',''), array('',''), $tirja2),
			'tirja3' 	=> str_replace(array(',',''), array('',''), $tirja3),
			'tirja4' 	=> str_replace(array(',',''), array('',''), $tirja4),
			'lain1' 		=> str_replace(array(',',''), array('',''), $lain1),
			'lain2' 		=> str_replace(array(',',''), array('',''), $lain2),
			'lain3' 		=> str_replace(array(',',''), array('',''), $lain3),
			'lain4' 		=> str_replace(array(',',''), array('',''), $lain4),
			'askes1' 	=> str_replace(array(',',''), array('',''), $askes1),
			'askes2' 	=> str_replace(array(',',''), array('',''), $askes2),
			'askes3' 	=> str_replace(array(',',''), array('',''), $askes3),
			'askes4' 	=> str_replace(array(',',''), array('',''), $askes4),
			'tirja11' 	=> str_replace(array(',',''), array('',''), $tirja11),
			'tirja12' 	=> str_replace(array(',',''), array('',''), $tirja12),
			'tirja13' 	=> str_replace(array(',',''), array('',''), $tirja13),
			'tirja14' 	=> str_replace(array(',',''), array('',''), $tirja14),
			'tirja21' 	=> str_replace(array(',',''), array('',''), $tirja21),
			'tirja22' 	=> str_replace(array(',',''), array('',''), $tirja22),
			'tirja23' 	=> str_replace(array(',',''), array('',''), $tirja23),
			'tirja24' 	=> str_replace(array(',',''), array('',''), $tirja24),
			'tirja31' 	=> str_replace(array(',',''), array('',''), $tirja31),
			'tirja32' 	=> str_replace(array(',',''), array('',''), $tirja32),
			'tirja33' 	=> str_replace(array(',',''), array('',''), $tirja33),
			'tirja34' 	=> str_replace(array(',',''), array('',''), $tirja34),
			'tirja41' 	=> str_replace(array(',',''), array('',''), $tirja41),
			'tirja42' 	=> str_replace(array(',',''), array('',''), $tirja42),
			'tirja43' 	=> str_replace(array(',',''), array('',''), $tirja43),
			'tirja44' 	=> str_replace(array(',',''), array('',''), $tirja44),
			'tirja45' 	=> str_replace(array(',',''), array('',''), $tirja45),
			'iwp1' 		=> str_replace(array(',',''), array('',''), $iwp1),
			'iwp2' 		=> str_replace(array(',',''), array('',''), $iwp2),
			'iwp3' 		=> str_replace(array(',',''), array('',''), $iwp3),
			'iwp4' 		=> str_replace(array(',',''), array('',''), $iwp4),
			'korpri1' 	=> str_replace(array(',',''), array('',''), $korpri1),
			'korpri2' 	=> str_replace(array(',',''), array('',''), $korpri2),
			'korpri3' 	=> str_replace(array(',',''), array('',''), $korpri3),
			'korpri4' 	=> str_replace(array(',',''), array('',''), $korpri4),
			'tabrumah1' 	=> str_replace(array(',',''), array('',''), $tabrumah1),
			'tabrumah2' 	=> str_replace(array(',',''), array('',''), $tabrumah2),
			'tabrumah3' 	=> str_replace(array(',',''), array('',''), $tabrumah3),
			'tabrumah4' 	=> str_replace(array(',',''), array('',''), $tabrumah4),
			'potjab1' 	=> str_replace(array(',',''), array('',''), $potjab1),
			'potjab2' 	=> str_replace(array(',',''), array('',''), $potjab2),
			'potjab3' 	=> str_replace(array(',',''), array('',''), $potjab3),
			'potjab4' 	=> str_replace(array(',',''), array('',''), $potjab4),
			'potpens1' 	=> str_replace(array(',',''), array('',''), $potpens1),
			'potpens2' 	=> str_replace(array(',',''), array('',''), $potpens2),
			'potpens3' 	=> str_replace(array(',',''), array('',''), $potpens3),
			'potpens4' 	=> str_replace(array(',',''), array('',''), $potpens4),
			'tht1' 		=> str_replace(array(',',''), array('',''), $tht1),
			'tht2' 		=> str_replace(array(',',''), array('',''), $tht2),
			'tht3' 		=> str_replace(array(',',''), array('',''), $tht3),
			'tht4' 		=> str_replace(array(',',''), array('',''), $tht4),
			'ptkp' 		=> str_replace(array(',',''), array('',''), $ptkp),
			'ptkp2' 		=> str_replace(array(',',''), array('',''), $ptkp2)
		);
		
		$simpan = $this->M_Komponen->saveData($header);			
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		
		
	}
	
	

}
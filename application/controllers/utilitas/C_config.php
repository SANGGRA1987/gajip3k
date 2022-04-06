<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_config extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('utilitas/M_config');
		$this->load->library('form_validation');        
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
	}

	public function index()
	{
		$sql = $this->M_config->load_config();
		
		$data['thang']		= $sql->thang;
		$data['periode']		= $sql->periode;
		$data['spm']		= $sql->spm;
		$data['kota']			= $sql->kota;
		$data['ankep']		= $sql->ankep;
		$data['jbankep']			= $sql->jbankep;
		$data['pangkep']		= $sql->pangkep;
		$data['nipankep']			= $sql->nipankep;
		$data['kpkeu']			= $sql->kpkeu;
		$data['jbkpkeu']		= $sql->jbkpkeu;
		$data['nipkpkeu']			= $sql->nipkpkeu;
		$data['kabkep']			= $sql->kabkep;
		$data['jkabkep']			= $sql->jkabkep;
		$data['nipkabkep']		= $sql->nipkabkep;
		$data['bpangkep']		= $sql->bpangkep;
		$data['kep']			= $sql->kep;
		$data['jbkep']		= $sql->jbkep;
		$data['nipkep']			= $sql->nipkep;
		$data['pkd']		= $sql->pkd;
		$data['jbpkd']			= $sql->jbpkd;
		$data['nippkd']			= $sql->nippkd;
		$data['nmsekda']		= $sql->nmsekda;
		$data['pangsekda']			= $sql->pangsekda;
		$data['nipsekda']			= $sql->nipsekda;
		$data['page'] 			= "Konfigurasi";
		$data['judul'] 			= "PENGATURAN";
		$data['deskripsi'] 		= "Konfigurasi";
		$this->template->views('utilitas/V_config', $data);
	}
	
	public function simpan_pemda()
	{
		$thang	= $this->input->post('thang');
		$periode	= $this->input->post('periode');
		$spm	= $this->input->post('spm');
		$kota	= $this->input->post('kota');
		$ankep	= $this->input->post('ankep');
		$jbankep	= $this->input->post('jbankep');
		$pangkep	= $this->input->post('pangkep');
		$nipankep	= $this->input->post('nipankep');
		$kpkeu	= $this->input->post('kpkeu');
		$jbkpkeu	= $this->input->post('jbkpkeu');
		$nipkpkeu	= $this->input->post('nipkpkeu');
		$kabkep	= $this->input->post('kabkep');
		$jkabkep	= $this->input->post('jkabkep');
		$nipkabkep	= $this->input->post('nipkabkep');
		$bpangkep	= $this->input->post('bpangkep');
		$kep	= $this->input->post('kep');
		$jbkep	= $this->input->post('jbkep');
		$nipkep	= $this->input->post('nipkep');
		$pkd	= $this->input->post('pkd');
		$jbpkd	= $this->input->post('jbpkd');
		$nippkd	= $this->input->post('nippkd');
		$nmsekda	= $this->input->post('nmsekda');
		$pangsekda	= $this->input->post('pangsekda');
		$nipsekda	= $this->input->post('nipsekda'); 

		$header 	= array(
			'thang' 		=> htmlspecialchars($thang, ENT_QUOTES),
			'periode' 		=> htmlspecialchars($periode, ENT_QUOTES),
			'spm'		=> htmlspecialchars($spm, ENT_QUOTES),
			'kota'		=> htmlspecialchars($kota, ENT_QUOTES),
			'ankep'		=> htmlspecialchars($ankep, ENT_QUOTES),
			'jbankep'		=> htmlspecialchars($jbankep, ENT_QUOTES),
			'pangkep'		=> htmlspecialchars($pangkep, ENT_QUOTES),
			'nipankep'		=> htmlspecialchars($nipankep, ENT_QUOTES),
			'kpkeu'		=> htmlspecialchars($kpkeu, ENT_QUOTES),
			'jbkpkeu'		=> htmlspecialchars($jbkpkeu, ENT_QUOTES),
			'nipkpkeu'		=> htmlspecialchars($nipkpkeu, ENT_QUOTES),
			'kabkep'		=> htmlspecialchars($kabkep, ENT_QUOTES),
			'jkabkep'		=> htmlspecialchars($jkabkep, ENT_QUOTES),
			'nipkabkep'		=> htmlspecialchars($nipkabkep, ENT_QUOTES),
			'bpangkep'		=> htmlspecialchars($bpangkep, ENT_QUOTES),
			'kep'		=> htmlspecialchars($kep, ENT_QUOTES),
			'jbkep'		=> htmlspecialchars($jbkep, ENT_QUOTES),
			'nipkep'		=> htmlspecialchars($nipkep, ENT_QUOTES),
			'pkd'		=> htmlspecialchars($pkd, ENT_QUOTES),
			'jbpkd'		=> htmlspecialchars($jbpkd, ENT_QUOTES),
			'nippkd'		=> htmlspecialchars($nippkd, ENT_QUOTES),
			'nmsekda'		=> htmlspecialchars($nmsekda, ENT_QUOTES),
			'pangsekda'		=> htmlspecialchars($pangsekda, ENT_QUOTES),
			'nipsekda'		=> htmlspecialchars($nipsekda, ENT_QUOTES) 
		);	

    	$simpan = $this->M_config->simpan_pemda($header);
    	if ($simpan) {
    		echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}		
	}
	
	public function ubah_pemda()
	{
		$data['page'] 			= "Konfigurasi";
		$data['judul'] 			= "Pengaturan";
		$data['deskripsi'] 		= "Konfigurasi";
		$this->template->views('utilitas/V_config_pemda', $data);
	}

	function get(){
		$res = $this->M_config->get();
    	echo json_encode($res);
	}
	
	
}

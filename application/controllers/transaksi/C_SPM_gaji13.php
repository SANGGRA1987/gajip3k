<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_SPM_gaji13 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_SPM_gaji13');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "SPM GAJI 13",
			'judul'		=> "SPM GAJI 13",
			'deskripsi'	=> "SPM GAJI 13"
		);

		$this->template->views('transaksi/dokumen/V_SPM_gaji13', $data);
	}


	function load_header(){
		$key = $this->input->post('key');
		$res = $this->M_SPM_gaji13->loadHeader($key);
    	echo json_encode($res);
	}

	public function add()
	{
		$data = array(
			'page' 		=> "SPM GAJI 13",
			'judul'		=> "SPM GAJI 13",
			'deskripsi'	=> "SPM GAJI 13"
		);

		$this->template->views('transaksi/dokumen/V_Add_SPM_gaji13', $data);
	}


	public function get_satker()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_SPM_gaji13->get_satker($lccq);
		echo json_encode($res);
	}

	public function golongan1()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_SPM_gaji13->golongan1($lccq);
		echo json_encode($res);
	}

    function untuk(){
		$satkerja = $this->input->post('satkerja');
		$gol1 = $this->input->post('gol1');
		$gol2 = $this->input->post('gol2');
		$res = $this->M_SPM_gaji13->untuk($satkerja,$gol1,$gol2);
    	echo json_encode($res);
	}

	function rekening(){
		$satkerja = $this->input->post('satkerja');
		$gol1 = $this->input->post('gol1');
		$gol2 = $this->input->post('gol2');
		$res = $this->M_SPM_gaji13->rekening($satkerja,$gol1,$gol2);
    	echo json_encode($res);
	}

	public function saveData(){
		
		$no_spm  	 = $this->input->post('no_spm');
		$no_spm1 	 = $this->input->post('no_spm1');
		$nomor_spm   = $this->input->post('nomor_spm');
		$nomor_sp2d  = $this->input->post('nomor_sp2d');
		$satkerja    = $this->input->post('satkerja');
		$kd_skpd 	 = $this->input->post('kd_skpd');
		$nm_satkerja = $this->input->post('nm_satkerja');
		$kd_giat 	 = $this->input->post('kd_giat');
		$nm_giat 	 = $this->input->post('nm_giat');
		$kd_program  = $this->input->post('kd_program');
		$nm_program  = $this->input->post('nm_program');
		$no_spd      = $this->input->post('no_spd');
		$no_rekening = $this->input->post('no_rekening');		
		$npwp   	 = $this->input->post('npwp');
		$bayar_kepada= $this->input->post('bayar_kepada');
		$tanggal     = $this->input->post('tanggal');
		$no_spp      = $this->input->post('no_spp');
		$bank        = $this->input->post('bank');
		$untuk       = $this->input->post('untuk');
		$total       = $this->input->post('total');
		$total_pot   = $this->input->post('total_pot');
		$user        = $this->session->userdata('nm_user');
		$tglupdate   = date('Y-m-d H:i:s');
		$status      = $this->input->post('status');	
		$bln         = $this->input->post('bln');		
		$data        = json_decode($this->input->post('detail'));
		$data2       = json_decode($this->input->post('detail2'));
		
		$header = array(
				'no_spm'  		=> htmlspecialchars($no_spm, ENT_QUOTES),
				'nomor_spm'  	=> htmlspecialchars($nomor_spm, ENT_QUOTES),
				'nomor_sp2d'  	=> htmlspecialchars($nomor_sp2d, ENT_QUOTES),
				'satkerja' 		=> htmlspecialchars($satkerja, ENT_QUOTES),				
				'nm_satkerja'   => htmlspecialchars($nm_satkerja, ENT_QUOTES),
				'kd_giat' 		=> htmlspecialchars($kd_giat, ENT_QUOTES),
				'nm_giat' 		=> htmlspecialchars($nm_giat, ENT_QUOTES),
				'kd_program' 	=> htmlspecialchars($kd_program, ENT_QUOTES),
				'nm_program' 	=> htmlspecialchars($nm_program, ENT_QUOTES),
				'kd_skpd' 		=> htmlspecialchars($kd_skpd, ENT_QUOTES),	
				'no_spd'        => htmlspecialchars($no_spd, ENT_QUOTES),
				'no_rekening'  => htmlspecialchars($no_rekening, ENT_QUOTES),
				'npwp'    		=> htmlspecialchars($npwp, ENT_QUOTES),
				'bayar_kepada'  => htmlspecialchars($bayar_kepada, ENT_QUOTES),
				'tanggal'  		=> htmlspecialchars($tanggal, ENT_QUOTES),
				'no_spp'    	=> htmlspecialchars($no_spp, ENT_QUOTES),
				'bank'     		=> htmlspecialchars($bank, ENT_QUOTES),
				'untuk'   		=> htmlspecialchars($untuk, ENT_QUOTES),
				'user'       	=> htmlspecialchars($user, ENT_QUOTES),
				'tglupdate'     => htmlspecialchars($tglupdate, ENT_QUOTES),
				'bln'     		=> htmlspecialchars($bln, ENT_QUOTES),
				'total'         => str_replace(array(',',''), array('',''), $total),
				'total_pot'     => str_replace(array(',',''), array('',''), $total_pot)
		);
		
		$h =	$this->M_SPM_gaji13->saveData($header,$status);
		if($h == 1){
				$sukses =	$this->M_SPM_gaji13->simpan_detail($nomor_spm,$status,$data,$data2,$kd_skpd,$no_spp,$kd_giat,$nm_giat,$no_spd);
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
		$sukses = $this->M_SPM_gaji13->hapus($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}

	function load_detail(){
        $data = array(
        	'nomor'		=> $this->input->post('no'), 	// no_dokumen
        	'skpd' 		=> $this->input->post('kode')	// uskpd
    	);

    	$res = $this->M_SPM_gaji13->load_detail($data);
    	echo json_encode($res);
    }

    function load_detail_pot(){
        $data = array(
        	'nomor'		=> $this->input->post('no'), 	
        	'skpd' 		=> $this->input->post('kode')	
    	);
    	$res = $this->M_SPM_gaji13->load_detail_pot($data);
    	echo json_encode($res);
    }

    function ambil_total(){
		$kd_skpd = $this->input->post('kd_skpd');
		$no_spm  = $this->input->post('no_spm');
		$res     = $this->M_SPM_gaji13->ambil_total($kd_skpd,$no_spm);
    	echo json_encode($res);
	}



}
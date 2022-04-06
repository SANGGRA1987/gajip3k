<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pegawai_gaji14 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_Pegawai_gaji14');
	}

	public function index()
	{
		$data = array(
			'page' 		=> "Data Pegawai 14",
			'judul'		=> "Data Pegawai 14",
			'deskripsi'	=> "Data Pegawai 14"
		);

		$this->template->views('master/V_Pegawai_gaji14', $data);
	}

	public function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}
		
	public function add()
	{
		$data = array(
			'page' 		=> "Data Pegawai 14",
			'judul'		=> "Data Pegawai 14",
			'deskripsi'	=> "Data Pegawai 14"
		);
		$this->template->views('master/V_Add_Pegawai_gaji14', $data);
	}

	public function info_gaji()
	{
		$data = array(
			'page' 		=> "Keterangan Gaji 14",
			'judul'		=> "Keterangan Gaji 14",
			'deskripsi'	=> "Keterangan Gaji 14"
		);
		$this->template->views('master/V_info_gaji_gaji14', $data);
	}
	
	public function get_statuskawin()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_statuskawin($lccq);
		echo json_encode($res);
	}

	public function get_kodebantu()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_kodebantu($lccq);
		echo json_encode($res);
	}

	public function get_agama()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_agama($lccq);
		echo json_encode($res);
	}

	public function get_satker()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_satker($lccq);
		echo json_encode($res);
	}

	public function getUnit()
	{
		$lccq 		= $this->input->post('q');
		$satkerja 		= $this->input->post('satkerja');
		$res 		= $this->M_Pegawai_gaji14->getUnit($lccq,$satkerja);
		echo json_encode($res);
	}

	public function get_gol()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_gol($lccq);
		echo json_encode($res);
	}

	public function get_masakerja()
	{
		$lccq 		= $this->input->post('q');
		$golongan 	= $this->input->post('golongan');
		$res 		= $this->M_Pegawai_gaji14->get_masakerja($lccq,$golongan);
		echo json_encode($res);
	}

	public function get_eselon()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_eselon($lccq);
		echo json_encode($res);
	}
	
	public function get_fungsional()
	{
		$lccq 		= $this->input->post('q');
		$golongan 	= $this->input->post('golongan');
		$res 		= $this->M_Pegawai_gaji14->get_fungsional($lccq,$golongan);
		echo json_encode($res);
	}

	public function get_khusus()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_khusus($lccq);
		echo json_encode($res);
	}

	public function get_pensiun()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_pensiun($lccq);
		echo json_encode($res);
	}

	public function get_bulan()
	{
		$lccq 		= $this->input->post('q');
		$res 		= $this->M_Pegawai_gaji14->get_bulan($lccq);
		echo json_encode($res);
	}

	function load_header(){
		$key = $this->input->post('key');
		$res = $this->M_Pegawai_gaji14->load_header($key);
    	echo json_encode($res);
	}

	public function hapus(){
		$param  = $this->input->post();
		$sukses = $this->M_Pegawai_gaji14->hapus($param);
		if( $sukses ){
			echo json_encode(array('pesan'=>true));
		} else {
			echo json_encode(array('pesan'=>false));
		}
	}

	public function simpan(){	 				
		$no_nip_lama 		= $this->input->post('no_nip_lama');
		$no_nip 			= $this->input->post('no_nip');		
		$nama 				= $this->input->post('nama');
		$kartu 				= $this->input->post('kartu');
		$tempat 			= $this->input->post('tempat');
		$agama 				= $this->input->post('agama');
		$status_kawin 		= $this->input->post('status_kawin');
		$j_anak 			= $this->input->post('j_anak');
		$satuan_kerja 		= $this->input->post('satuan_kerja');
		$unit_kerja 		= $this->input->post('unit_kerja');
		$gol 				= $this->input->post('gol');
		$masa_kerja1 		= $this->input->post('masa_kerja1');
		$masa_kerja2 		= $this->input->post('masa_kerja2');
		$t_struktural 		= $this->input->post('t_struktural');
		$k_bantu 			= $this->input->post('k_bantu');
		$gapok 				= $this->input->post('gapok');
		$n_struktural 		= $this->input->post('n_struktural');
		$n_fungsional 		= $this->input->post('n_fungsional');
		$n_khusus 			= $this->input->post('n_khusus');
		$umum 				= $this->input->post('umum');
		$sewa_rumah 		= $this->input->post('sewa_rumah');
		$taperum 			= $this->input->post('taperum');
		$h_pembayaran 		= $this->input->post('h_pembayaran');
		$pot_lain 			= $this->input->post('pot_lain');
		$k_perubahan 		= $this->input->post('k_perubahan');
		$norek_bank 		= $this->input->post('norek_bank');
		$batas_pensiun 		= $this->input->post('batas_pensiun');
		$skorsing 			= $this->input->post('skorsing');
		$t_fungsional 		= $this->input->post('t_fungsional');
		$t_khusus 			= $this->input->post('t_khusus');
		//$t_terpencil 		= $this->input->post('t_terpencil');
		$npwp 				= $this->input->post('npwp');
		$tgl_lahir 			= $this->input->post('tgl_lahir');
		$tgl_pns 			= $this->input->post('tgl_pns');
		$tgl_kepangkatan 	= $this->input->post('tgl_kepangkatan');
		$tgl_berkala 		= $this->input->post('tgl_berkala');
		$tgl_jabatan 		= $this->input->post('tgl_jabatan');
		$tgl_fungsional 	= $this->input->post('tgl_fungsional');
		$jenis_kelamin 		= $this->input->post('jenis_kelamin');
		$s_pegawai1 		= $this->input->post('s_pegawai1');
		$s_pegawai2 		= $this->input->post('s_pegawai2');
		$tunj_beras 		= $this->input->post('tunj_beras');
		$s_pegawai3 		= $this->input->post('s_pegawai3');
		$pilihan 			= $this->input->post('pilihan');
		$tistri 			= $this->input->post('tistri');
		$tanak 				= $this->input->post('tanak');
		$askes 				= $this->input->post('askes');
		$jkk 				= $this->input->post('jkk');
		$jkm 				= $this->input->post('jkm');
		$status 			= $this->input->post('status');
		$tunggakan 			= $this->input->post('tunggakan');
		$beras 				= $this->input->post('beras');
		$iwp 				= $this->input->post('iwp');
		$tht 				= $this->input->post('tht');
		$papua 				= $this->input->post('papua');
		$pph 				= $this->input->post('pph');
		$disc 				= $this->input->post('disc');
		$bulat 				= $this->input->post('bulat');
		$bruto 				= $this->input->post('bruto');
		$netto 				= $this->input->post('netto');

		$header 	= array(
				 'no_nip_lama'	=> htmlspecialchars($no_nip_lama, ENT_QUOTES),
				 'no_nip'  	  	=> htmlspecialchars($no_nip, ENT_QUOTES),		
				 'nama'  	  	=> htmlspecialchars($nama, ENT_QUOTES),
				 'kartu'  	  	=> str_replace(array(',',''), array('',''), $kartu),
				 'tempat'  	  	=> htmlspecialchars($tempat, ENT_QUOTES),
				 'agama'  	  	=> str_replace(array(',',''), array('',''), $agama),
				 'status_kawin'	=> str_replace(array(',',''), array('',''), $status_kawin),
				 'j_anak'  	  	=> str_replace(array(',',''), array('',''), $j_anak),
				 'satuan_kerja'	=> htmlspecialchars($satuan_kerja, ENT_QUOTES),
				 'unit_kerja'  	=> htmlspecialchars($unit_kerja, ENT_QUOTES),
				 'gol'  	  	=> htmlspecialchars($gol, ENT_QUOTES),
				 'masa_kerja1'  => htmlspecialchars($masa_kerja1, ENT_QUOTES),
				 'masa_kerja2'  => str_replace(array(',',''), array('',''), $masa_kerja2),
				 't_struktural' => htmlspecialchars($t_struktural, ENT_QUOTES),
				 'k_bantu'  	=> str_replace(array(',',''), array('',''), $k_bantu),
				 'gapok'  	  	=> str_replace(array(',',''), array('',''), $gapok),
				 'n_struktural' => str_replace(array(',',''), array('',''), $n_struktural),
				 'n_fungsional' => str_replace(array(',',''), array('',''), $n_fungsional),
				 'n_khusus' 	=> str_replace(array(',',''), array('',''), $n_khusus),
				 'umum' 		=> str_replace(array(',',''), array('',''), $umum),
				 'sewa_rumah'  	=> str_replace(array(',',''), array('',''), $sewa_rumah),
				 'taperum'  	=> str_replace(array(',',''), array('',''), $taperum),
				 'h_pembayaran' => str_replace(array(',',''), array('',''), $h_pembayaran),
				 'pot_lain'  	=> str_replace(array(',',''), array('',''), $pot_lain),
				 'k_perubahan'  => htmlspecialchars($k_perubahan, ENT_QUOTES),
				 'norek_bank'  	=> htmlspecialchars($norek_bank, ENT_QUOTES),
				 'batas_pensiun' => str_replace(array(',',''), array('',''), $batas_pensiun),
				 'skorsing'  	=> str_replace(array(',',''), array('',''), $skorsing),
				 't_fungsional' => htmlspecialchars($t_fungsional, ENT_QUOTES),
				 't_khusus' 	=> htmlspecialchars($t_khusus, ENT_QUOTES),
				 //'t_terpencil'  => str_replace(array(',',''), array('',''), $t_terpencil),
				 'npwp'  	  	=> htmlspecialchars($npwp, ENT_QUOTES),
				 'tgl_lahir'  	  => htmlspecialchars($tgl_lahir, ENT_QUOTES),
				 'tgl_pns'  	  => htmlspecialchars($tgl_pns, ENT_QUOTES),
				 'tgl_kepangkatan'=> htmlspecialchars($tgl_kepangkatan, ENT_QUOTES),
				 'tgl_berkala' 	=> htmlspecialchars($tgl_berkala, ENT_QUOTES),
				 'tgl_jabatan' 	=> htmlspecialchars($tgl_jabatan, ENT_QUOTES),
				 'tgl_fungsional' => htmlspecialchars($tgl_fungsional, ENT_QUOTES),
				 'jenis_kelamin' => htmlspecialchars($jenis_kelamin, ENT_QUOTES),
				 's_pegawai1' 	=> htmlspecialchars($s_pegawai1, ENT_QUOTES),
				 's_pegawai2' 	=> htmlspecialchars($s_pegawai2, ENT_QUOTES),
				 'tunj_beras' 	=> htmlspecialchars($tunj_beras, ENT_QUOTES),
				 's_pegawai3' 	=> htmlspecialchars($s_pegawai3, ENT_QUOTES),
				 'pilihan' 		=> htmlspecialchars($pilihan, ENT_QUOTES),
				 'tistri'  	  	=> str_replace(array(',',''), array('',''), $tistri),
				 'tanak'  	  	=> str_replace(array(',',''), array('',''), $tanak),
				 'askes'  	  	=> str_replace(array(',',''), array('',''), $askes),
				 'jkk'  	  	=> str_replace(array(',',''), array('',''), $jkk),
				 'jkm'  	  	=> str_replace(array(',',''), array('',''), $jkm),
				 'status' 		=> htmlspecialchars($status, ENT_QUOTES),
				 'tunggakan'  	=> str_replace(array(',',''), array('',''), $tunggakan),
				 'beras'  		=> str_replace(array(',',''), array('',''), $beras),
				 'iwp'  		=> str_replace(array(',',''), array('',''), $iwp),
				 'tht'  		=> str_replace(array(',',''), array('',''), $tht),
				 'papua'  		=> str_replace(array(',',''), array('',''), $papua),
				 'pph'  		=> str_replace(array(',',''), array('',''), $pph),
				 'disc'  		=> str_replace(array(',',''), array('',''), $disc),
				 'bulat'  		=> str_replace(array(',',''), array('',''), $bulat),
				 'bruto'  		=> str_replace(array(',',''), array('',''), $bruto),
				 'netto'  		=> str_replace(array(',',''), array('',''), $netto)
		);
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		$config['max_size']  = '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		$simpan = $this->M_Pegawai_gaji14->saveData($header);
			
		if ($simpan) {
			echo json_encode(array('pesan'=>true,'message' => 'Data Tersimpan !'));
		}else {
			echo json_encode(array('pesan'=>false,'message'=>'Gagal Menyimpan data !'));
		}
		
		
	}
	
	

}
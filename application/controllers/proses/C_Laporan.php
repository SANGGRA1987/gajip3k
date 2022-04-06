<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('proses/M_Cetak_Lap');
	}
	
	public function index(){
		$this->template->views('home');
	}

	public function form_b(){
		//define('PRINT_SERVER',HOST."/simgaji_new/application/models/service/");
		//simgaji_new\application\models\proses
		$kode_satker 	= $_POST['kd_satker'];
		$kode_unit 		= $_POST['kd_unit'];
		$kode_golongan 	= $_POST['kd_golongan'];

		$data_insert = array(
			'kode_golongan' => $kode_golongan,
			'kode_satker' => $kode_satker,
			'kode_unit' => $kode_unit
		);
		$res = $this->M_Cetak_Lap->Laporan('tampung.form_b',$data_insert);
		if ($res >= 1) {
			redirect ('proses/C_Laporan/index');
		}else{
			echo "Insert Data Gagal !!";
		}


	}

	public function skp(){
		//define('PRINT_SERVER',HOST."/simgaji_new/application/models/service/");
		$nip  = $_POST['nip_pegawai'];
		$nama = $_POST['nama_pegawai'];

		$data_insert = array(
			'nim' => $nim,
			'nama' => $nama,
			'alamat' => $alamat
		);
		$res = $this->mymodel->InsertData('mahasiswa',$data_insert);
		if ($res >= 1) {
			redirect ('crud/index');
		}else{
			echo "Insert Data Gagal !!";
		}
		

	

	}

	public function rtb(){

	}



	
}

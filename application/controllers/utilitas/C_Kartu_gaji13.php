<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kartu_gaji13 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_Kartu_gaji13');
	}

	public function index()
	{	
		$data = array(
			'page'	 	=> 'Pengkartuan Gaji 13 Pegawai ',
			'judul'		=> 'Pengkartuan Gaji 13 Pegawai ',
			'deskripsi'	=> 'Pengkartuan Gaji 13 Pegawai '
		);

		$this->template->views('utilitas/V_Kartu_gaji13', $data);
	}

	public function getBulan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Kartu_gaji13->getBulan($lccq);
		echo json_encode($res);
	}

	public function getConfig()
	{
		return $this->M_Kartu_gaji13->getConfig();
	}

	function proses(){
		$bulan = $this->input->get('bulan'); 
		$config = $this->getConfig();
		$thn	= $config['thn']; 
		$periode = $bulan.$thn; 

		$sqlList = ['DROP TABLE IF EXISTS "public"."pegawai_13_'.$periode.'";',
			'CREATE TABLE "public"."pegawai_13_'.$periode.'" (
            nip_lama varchar(18) ,
			nip varchar(18),
			nama varchar(40) ,
			nokartu numeric(5),
			seks numeric(1),
			kota varchar(20) ,
			agama numeric(1),
			stskawin numeric(1),
			anak numeric(1),
			satkerja varchar(7) ,
			unit varchar(3) ,
			stspegawai numeric(1),
			golongan char(2) ,
			masa_tahun char(2) ,
			eselon char(5) ,
			kdbantu numeric(1),
			kdguru numeric(1),
			gapok numeric(9),
			tistri numeric(9),
			tanak numeric(9),
			tpp numeric(9),
			kenaikan numeric(9),
			tstruk numeric(9),
			tfung numeric(9),
			tkespeg numeric(9),
			bulat numeric(9),
			beras numeric(9),
			pph numeric(9),
			bruto numeric(9),
			iwp numeric(9),
			sewa numeric(9),
			tunggakan numeric(9),
			tabungan numeric(9),
			hutang numeric(9),
			lain numeric(9),
			potongan numeric(9),
			netto numeric(9),
			ket varchar(100) ,
			rekening varchar(30) ,
			pensiun numeric(2),
			skorsing numeric(6),
			photo_file varchar(255) ,
			notes varchar(255) ,
			photo varchar(255) ,
			papua numeric(15),
			kd_beras numeric(1),
			kd_fung char(2) ,
			tdt numeric(10),
			disc numeric(10),
			status char(6) ,
			kd_daerah numeric(1),
			nip2 char(18) ,
			askes numeric(9),
			npwp varchar(50) ,
			lahir varchar(20) ,
			tmt_pns char(10) ,
			tmt_pangkat char(10) ,
			tmt_berkala char(10) ,
			sk_jab char(10) ,
			sk_fung char(10) ,
			masa_bulan char(2) ,
			jkk numeric(9),
			jkm numeric(9),
			khusus numeric(9),
			tht numeric(9),
			kd_khusus char(6) ,
			umum numeric(9),
			kd_pil numeric(1),
            PRIMARY KEY (nip)
        );'];
 
        foreach ($sqlList as $sql) {
            $this->db->query($sql);
        }

        $this->db->query("delete from public.pegawai_13_$periode");		
		$this->db->query("insert into public.pegawai_13_$periode select * from public.pegawai_13");		  
		
        echo 'Proses Pengkartuan Gaji 13 Pegawai  Bulan '.$bulan.' Tahun '.$thn.' Berhasil';	
 	}
	
	
 

}


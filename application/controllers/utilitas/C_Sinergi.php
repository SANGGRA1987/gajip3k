<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Sinergi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_Sinergi');
	}

	public function index()
	{	
		$data = array(
			'page'	 	=> 'ADK SINERGI',
			'judul'		=> 'ADK SINERGI',
			'deskripsi'	=> 'ADK SINERGI'
		);

		$this->template->views('utilitas/V_Sinergi', $data);
	}

	public function getBulan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Sinergi->getBulan($lccq);
		echo json_encode($res);
	}

	public function getConfig()
	{
		return $this->M_Sinergi->getConfig();
	}

 	function proses(){
		$bulan = $this->input->get('bulan'); 
		$config = $this->getConfig();
		$thn	= $config['thn']; 
		$periode = $bulan.$thn;

		//rekap
		$cRet ='';
		$cRet .="
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tahungaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">bulangaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodeprovinsi</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodekabkota</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jenisdata</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodegolongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraiangolongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahpegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahanak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">gajipokok</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganistrisuami</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangananak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganperbaikanpenghasilan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganstruktural</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganfungsional</td>
    			<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjabatankhusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganumum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangankemahalan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganterpencil</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganaskes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpajak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpembulatan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganberas</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpendidikan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjkk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjkm</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahkotor</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">iwp</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">iwp8</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">iwp2</td>                    
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganaskes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganbulog</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potongantaperum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganpajak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potongansewarumah</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganhutang</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganjkk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganjkm</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahpotongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangandaerah</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahbersih</td>
    		</tr>";

    		$sql="SELECT $thn as tahunGaji, 
				$bulan as bulanGaji, 
				17 as kodeProvinsi, 
				01 as kodeKabKota, 
				12 as jenisData, 
				a.golongan as kodegolongan,
				b.nm_golongan as uraiangolongan,  
				count(a.nip) as jumlahPegawai,  
				sum(a.anak) as jumlahAnak, 
				sum(a.gapok) as gajiPokok, 
				sum(a.tistri) as tunjanganIstriSuami, 
				sum(a.tanak) as tunjanganAnak, 
				0 as tunjanganPerbaikanPenghasilan, 
				sum(a.tstruk) as tunjanganStruktural,  
				SUM(a.tfung) as tunjanganFungsional, 
				SUM(a.khusus) as tunjanganJabatanKhusus, 
				sum(a.umum) as tunjanganUmum, 
				0 as tunjanganKemahalan, 
				0 as tunjanganTerpencil, 
				SUM(a.askes) as tunjanganAskes, 
				sum(a.pph) as tunjanganPajak, 
				SUM(a.bulat) as tunjanganPembulatan, 
				sum(a.beras) as tunjanganBeras, 
				0 as tunjanganPendidikan, 
				sum(a.jkk) as tunjanganJKK, 
				sum(a.jkm) as tunjanganJKM, 
				sum( a.gapok+a.tistri+a.tanak+a.tstruk+a.tfung+a.umum+a.askes+a.pph+a.bulat+a.beras+a.khusus+a.jkk+a.jkm ) as jumlahKotor, 
				sum(a.iwp) as iwp, 
				0 as iwp8, 
				0 as iwp2, 
				sum(a.askes) as potonganAskes, 
				0 as potonganBulog, 
				sum(a.tabungan) as potonganTaperum, 
				sum(a.pph) as potonganPajak, 
				sum(a.sewa) as potonganSewaRumah, 
				sum(a.hutang) as potonganHutang, 
				sum(a.jkk) as potonganJKK, 
				sum(a.jkm) as potonganJKM, 
				sum(a.iwp+a.askes+a.tabungan+a.pph+a.sewa+a.hutang+a.jkk+a.jkm) as jumlahPotongan, 
				0 as tunjanganDaerah, 
				sum( a.netto ) as jumlahBersih  
				from public.p3k_$periode a INNER JOIN golongan b on a.golongan=b.golongan
				WHERE a.nip != '' group by tahunGaji,bulanGaji,kodeProvinsi,kodeKabKota,jenisData,kodeGolongan,uraianGolongan;";
			$query = $this->db->query($sql);

			foreach ($query->result() as $row) {
				$ctahungaji 	= $row->tahungaji ;
				$cbulangaji 	= $row->bulangaji ;
				$ckodeprovinsi 	= $row->kodeprovinsi ;
				$ckodekabkota 	= $row->kodekabkota ;
				$cjenisdata 	= $row->jenisdata ;
				$ckodegolongan 	= $row->kodegolongan ;
				$curaiangolongan 	= $row->uraiangolongan ;
				$cjumlahpegawai 	= $row->jumlahpegawai ;
				$cjumlahanak 	= $row->jumlahanak ;
				$cgajipokok 	= $row->gajipokok ;
				$ctunjanganistrisuami 	= $row->tunjanganistrisuami ;
				$ctunjangananak 	= $row->tunjangananak ;
				$ctunjanganperbaikanpenghasilan 	= $row->tunjanganperbaikanpenghasilan ;
				$ctunjanganstruktural 	= $row->tunjanganstruktural ;
				$ctunjanganfungsional 	= $row->tunjanganfungsional ;
				$ctunjanganjabatankhusus 	= $row->tunjanganjabatankhusus ;
				$ctunjanganumum 	= $row->tunjanganumum ;
				$ctunjangankemahalan 	= $row->tunjangankemahalan ;
				$ctunjanganterpencil 	= $row->tunjanganterpencil ;
				$ctunjanganaskes 	= $row->tunjanganaskes ;
				$ctunjanganpajak 	= $row->tunjanganpajak ;
				$ctunjanganpembulatan 	= $row->tunjanganpembulatan ;
				$ctunjanganberas 	= $row->tunjanganberas ;
				$ctunjanganpendidikan 	= $row->tunjanganpendidikan ;
				$ctunjanganjkk 	= $row->tunjanganjkk ;
				$ctunjanganjkm 	= $row->tunjanganjkm ;
				$cjumlahkotor 	= $row->jumlahkotor ;
				$ciwp 	= $row->iwp ;
				$ciwp8 	= $row->iwp8 ;
				$ciwp2 	= $row->iwp2 ;
				$cpotonganaskes 	= $row->potonganaskes ;
				$cpotonganbulog 	= $row->potonganbulog ;
				$cpotongantaperum 	= $row->potongantaperum ;
				$cpotonganpajak 	= $row->potonganpajak ;
				$cpotongansewarumah 	= $row->potongansewarumah ;
				$cpotonganhutang 	= $row->potonganhutang ;
				$cpotonganjkk 	= $row->potonganjkk ;
				$cpotonganjkm 	= $row->potonganjkm ;
				$cjumlahpotongan 	= $row->jumlahpotongan ;
				$ctunjangandaerah 	= $row->tunjangandaerah ;
				$cjumlahbersih 	= $row->jumlahbersih ;

			$cRet .="
   			         <tr>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctahungaji</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbulangaji</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodeprovinsi</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodekabkota</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjenisdata</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodegolongan</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaiangolongan</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahpegawai</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahanak</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cgajipokok</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganistrisuami</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangananak</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganperbaikanpenghasilan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganstruktural</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganfungsional</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjabatankhusus</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganumum</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangankemahalan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganterpencil</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganaskes</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpajak</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpembulatan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganberas</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpendidikan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjkk</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjkm</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahkotor</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ciwp</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ciwp8</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ciwp2</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganaskes</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganbulog</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotongantaperum</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganpajak</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotongansewarumah</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganhutang</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganjkk</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganjkm</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahpotongan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangandaerah</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahbersih</td>		                        
                    </tr>";
            } 

    		$cRet .="</table>";
    		$data['prev']= $cRet;
			$judul  = 'adk_sinergi_rekap_'.$periode;
    		header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
 	}

 	function proses2(){
		$bulan = $this->input->get('bulan'); 
		$config = $this->getConfig();
		$thn	= $config['thn']; 
		$periode = $bulan.$thn;

		//detail
        $cRet ='';
		$cRet .="
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tahungaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">bulangaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodeprovinsi</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodekabkota</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jenisdata</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodeskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namaskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodesatkerskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namasatkerskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nippegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namapegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">npwp</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodestatuspegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraianstatuspegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">masakerja</td>
    			<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namastatuskawin</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jeniskelamin</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tanggallahir</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nomorrekening</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namabank</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodeeselon</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">telepon</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">email</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodegolongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraiangolongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodejabatanstruktural</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraianjabatanstruktural</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodekelompokfungsional</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraiankelompokfungsional</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodejabatanfungsional</td>                    
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraianjabatanfungsional</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodejabatankhusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraianjabatankhusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodeguru</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraianguru</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodesertifikasi</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">uraiansertifikasi</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahistrisuami</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahanak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">gajipokok</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">persengaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganistrisuami</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangananak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganperbaikanpenghasilan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganstruktural</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganfungsional</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjabatankhusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganumum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangankemahalan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganterpencil</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganaskes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpajak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpembulatan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganberas</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganpendidikan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganeselon</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganguru</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangankelangkaan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangankhusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjkk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjanganjkm</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahkotor</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganiwp10</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganiwp8</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganiwp2</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganaskes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganbulog</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potongantaperum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganpajak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potongansewarumah</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganhutang</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganjkk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potonganjkm</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahpotongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nilaitambahanpenghasilan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlahbersih</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodebayartp</td>
    		</tr>";

    	$sql2="SELECT $thn as tahunGaji, 
						$bulan as bulanGaji, 
						17 as kodeProvinsi, 
						01 as kodeKabKota, 
						12 as jenisData, 
						a.satkerja as kodeSKPD, 
						(SELECT nm_satkerja FROM satkerja WHERE satkerja= a.satkerja) as namaSKPD, 
						a.satkerja as kodeSatkerSKPD, 
						(SELECT nm_satkerja FROM satkerja WHERE satkerja = a.satkerja) as namaSatkerSKPD, 
						a.nip as nipPegawai, 
						a.nama as namaPegawai, 
						CASE
						when a.npwp <> '' then a.npwp
						else '000000000000000' END as npwp,
						a.stspegawai as kodeStatusPegawai,  
						'PEGAWAI BULANAN' as uraianStatusPegawai,  
						a.masa_tahun as masaKerja, 
						CASE
						when a.stskawin=1 THEN 'Kawin dengan Tunjangan Keluarga'
						when a.stskawin=2 THEN 'Kawin tanpa Tunjangan Keluarga'
						when a.stskawin=3 THEN 'Tidak Kawin'
						when a.stskawin=4 THEN 'Duda'
						else 'Janda' END as namaStatusKawin,
						a.seks as jenisKelamin, 
						a.lahir as tanggalLahir, 
						a.rekening as nomorRekening, 
						' ' as namaBank, 
						a.eselon as kodeEselon,  
						' ' as telepon, 
						' ' as email,  
						a.golongan as kodeGolongan, 
						b.nm_golongan as uraiangolongan,  
						CASE
						when a.eselon <> '' THEN a.eselon
						else '00' END as kodeJabatanStruktural,
						CASE
						when a.eselon <> '' THEN (select nm_eselon from eselon where eselon=a.eselon)
						else 'NON ESELON' END as uraianJabatanStruktural,
						'00' as kodeKelompokFungsional,   
						'NON JABATAN' as uraianKelompokFungsional,  
						CASE
						when a.kd_fung <> '' THEN a.kd_fung
						else '0000' END as kodeJabatanFungsional,
						CASE
						when a.kd_fung <> '' THEN (select ket from fungsional where kd_fung=a.kd_fung and golongan=a.golongan)
						else 'NON FUNGSIONAL' END as uraianJabatanFungsional,
						CASE
						when a.kd_khusus <> '' THEN a.kd_khusus
						else '0000' END as kodeJabatanKhusus,
						 CASE
						when a.kd_khusus <> '' THEN (select uraian from mtunj_khusus where kd_khusus=a.kd_khusus)
						else 'NON TUNJANGAN KHUSUS' END as uraianJabatanKhusus, 
						CASE
						when a.kdguru <> 0 THEN a.kdguru
						else 00 END as kodeGuru,
						CASE
						when a.kdguru = 1 then 'NON GURU'
						when a.kdguru = 2 then 'BIDAN'
						when a.kdguru = 3 then 'PERAWAT'
						when a.kdguru = 4 then 'GURU'
						when a.kdguru = 5 then 'KESEHATAN'
						else '' END as uraianGuru, 
						'' as kodeSertifikasi,  
						'' as uraianSertifikasi, 
						CASE
						when a.stskawin = 1 THEN 1
						else 0 END as jumlahIstriSuami,
						a.anak as jumlahAnak, 
						a.gapok as gajiPokok, 
						100 as persenGaji, 
						a.tistri as tunjanganIstriSuami, 
						a.tanak as tunjanganAnak, 
						0 as tunjanganPerbaikanPenghasilan, 
						a.tstruk as tunjanganStruktural, 
						a.tfung as tunjanganFungsional, 
						a.khusus as tunjanganJabatanKhusus,  
						a.umum as tunjanganUmum, 
						0 as tunjanganKemahalan, 
						0 as tunjanganTerpencil, 
						a.askes as tunjanganAskes, 
						a.pph as tunjanganPajak, 
						a.bulat as tunjanganPembulatan, 
						a.beras as tunjanganBeras, 
						0 as tunjanganPendidikan, 
						a.tstruk as tunjanganEselon, 
						0 as tunjanganguru, 
						0 as tunjanganKelangkaan, 
						a.khusus as tunjanganKhusus, 
						a.jkk as tunjanganJKK, 
						a.jkm as tunjanganJKM, 
						(a.gapok+a.tistri+a.tanak+a.tstruk+a.tfung+a.umum+a.askes+a.pph+a.bulat+a.beras+a.khusus+a.jkk+a.jkm) as jumlahKotor, 
						a.iwp as potonganIWP10, 
						0 as potonganIWP8, 
						0 as potonganIWP2, 
						a.askes as potonganAskes, 
						0 as potonganBulog, 
						a.tabungan as potonganTaperum, 
						a.pph as potonganPajak, 
						a.sewa as potonganSewaRumah, 
						a.hutang as potonganHutang, 
						a.jkk as potonganJKK, 
						a.jkm as potonganJKM, 
						(a.iwp+a.askes+a.tabungan+a.pph+a.sewa+a.hutang+a.jkk+a.jkm) as jumlahPotongan, 
						0 as nilaiTambahanPenghasilan, 
						a.netto as jumlahbersih,  
						'0' as kodeBayarTP 
						from public.p3k_$periode a INNER JOIN golongan b on a.golongan=b.golongan WHERE a.nip != '';";
			$query = $this->db->query($sql2);
			foreach ($query->result() as $row) {
				$ctahungaji = $row->tahungaji ;
				$cbulangaji = $row->bulangaji ;
				$ckodeprovinsi = $row->kodeprovinsi ;
				$ckodekabkota = $row->kodekabkota ;
				$cjenisdata = $row->jenisdata ;
				$ckodeskpd = $row->kodeskpd ;
				$cnamaskpd = $row->namaskpd ;
				$ckodesatkerskpd = $row->kodesatkerskpd ;
				$cnamasatkerskpd = $row->namasatkerskpd ;
				$cnippegawai = $row->nippegawai ;
				$cnamapegawai = $row->namapegawai ;
				$cnpwp = $row->npwp ;
				$ckodestatuspegawai = $row->kodestatuspegawai ;
				$curaianstatuspegawai = $row->uraianstatuspegawai ;
				$cmasakerja = $row->masakerja ;
				$cnamastatuskawin = $row->namastatuskawin ;
				$cjeniskelamin = $row->jeniskelamin ;
				$ctanggallahir = $row->tanggallahir ;
				$cnomorrekening = $row->nomorrekening ;
				$cnamabank = $row->namabank ;
				$ckodeeselon = $row->kodeeselon ;
				$ctelepon = $row->telepon ;
				$cemail = $row->email ;
				$ckodegolongan = $row->kodegolongan ;
				$curaiangolongan = $row->uraiangolongan ;
				$ckodejabatanstruktural = $row->kodejabatanstruktural ;
				$curaianjabatanstruktural = $row->uraianjabatanstruktural ;
				$ckodekelompokfungsional = $row->kodekelompokfungsional ;
				$curaiankelompokfungsional = $row->uraiankelompokfungsional ;
				$ckodejabatanfungsional = $row->kodejabatanfungsional ;
				$curaianjabatanfungsional = $row->uraianjabatanfungsional ;
				$ckodejabatankhusus = $row->kodejabatankhusus ;
				$curaianjabatankhusus = $row->uraianjabatankhusus ;
				$ckodeguru = $row->kodeguru ;
				$curaianguru = $row->uraianguru ;
				$ckodesertifikasi = $row->kodesertifikasi ;
				$curaiansertifikasi = $row->uraiansertifikasi ;
				$cjumlahistrisuami = $row->jumlahistrisuami ;
				$cjumlahanak = $row->jumlahanak ;
				$cgajipokok = $row->gajipokok ;
				$cpersengaji = $row->persengaji ;
				$ctunjanganistrisuami = $row->tunjanganistrisuami ;
				$ctunjangananak = $row->tunjangananak ;
				$ctunjanganperbaikanpenghasilan = $row->tunjanganperbaikanpenghasilan ;
				$ctunjanganstruktural = $row->tunjanganstruktural ;
				$ctunjanganfungsional = $row->tunjanganfungsional ;
				$ctunjanganjabatankhusus = $row->tunjanganjabatankhusus ;
				$ctunjanganumum = $row->tunjanganumum ;
				$ctunjangankemahalan = $row->tunjangankemahalan ;
				$ctunjanganterpencil = $row->tunjanganterpencil ;
				$ctunjanganaskes = $row->tunjanganaskes ;
				$ctunjanganpajak = $row->tunjanganpajak ;
				$ctunjanganpembulatan = $row->tunjanganpembulatan ;
				$ctunjanganberas = $row->tunjanganberas ;
				$ctunjanganpendidikan = $row->tunjanganpendidikan ;
				$ctunjanganeselon = $row->tunjanganeselon ;
				$ctunjanganguru = $row->tunjanganguru ;
				$ctunjangankelangkaan = $row->tunjangankelangkaan ;
				$ctunjangankhusus = $row->tunjangankhusus ;
				$ctunjanganjkk = $row->tunjanganjkk ;
				$ctunjanganjkm = $row->tunjanganjkm ;
				$cjumlahkotor = $row->jumlahkotor ;
				$cpotonganiwp10 = $row->potonganiwp10 ;
				$cpotonganiwp8 = $row->potonganiwp8 ;
				$cpotonganiwp2 = $row->potonganiwp2 ;
				$cpotonganaskes = $row->potonganaskes ;
				$cpotonganbulog = $row->potonganbulog ;
				$cpotongantaperum = $row->potongantaperum ;
				$cpotonganpajak = $row->potonganpajak ;
				$cpotongansewarumah = $row->potongansewarumah ;
				$cpotonganhutang = $row->potonganhutang ;
				$cpotonganjkk = $row->potonganjkk ;
				$cpotonganjkm = $row->potonganjkm ;
				$cjumlahpotongan = $row->jumlahpotongan ;
				$cnilaitambahanpenghasilan = $row->nilaitambahanpenghasilan ;
				$cjumlahbersih = $row->jumlahbersih ;
				$ckodebayartp = $row->kodebayartp ;

			$cRet .="
   			        <tr>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctahungaji</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbulangaji</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodeprovinsi</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodekabkota</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjenisdata</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodeskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamaskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodesatkerskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamasatkerskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">'$cnippegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamapegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnpwp</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodestatuspegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaianstatuspegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cmasakerja</td>
		    			<td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamastatuskawin</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjeniskelamin</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctanggallahir</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnomorrekening</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamabank</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodeeselon</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctelepon</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cemail</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodegolongan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaiangolongan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodejabatanstruktural</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaianjabatanstruktural</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodekelompokfungsional</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaiankelompokfungsional</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodejabatanfungsional</td>                    
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaianjabatanfungsional</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodejabatankhusus</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaianjabatankhusus</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodeguru</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaianguru</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodesertifikasi</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$curaiansertifikasi</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahistrisuami</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahanak</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cgajipokok</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpersengaji</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganistrisuami</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangananak</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganperbaikanpenghasilan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganstruktural</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganfungsional</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjabatankhusus</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganumum</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangankemahalan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganterpencil</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganaskes</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpajak</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpembulatan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganberas</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganpendidikan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganeselon</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganguru</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangankelangkaan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangankhusus</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjkk</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjanganjkm</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahkotor</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganiwp10</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganiwp8</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganiwp2</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganaskes</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganbulog</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotongantaperum</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganpajak</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotongansewarumah</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganhutang</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganjkk</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotonganjkm</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahpotongan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnilaitambahanpenghasilan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlahbersih</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodebayartp</td>		                        
                	</tr>";
            }

    	$cRet .="</table>";
		$data['prev']= $cRet;
		$judul  = 'adk_sinergi_detail_'.$periode;
		header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename= $judul.xls");
        $this->load->view('transaksi/excel', $data);
 	}
	
	
 

}


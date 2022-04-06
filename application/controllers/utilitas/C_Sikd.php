<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Sikd extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('utilitas/M_Sikd');
	}

	public function index()
	{	
		$data = array(
			'page'	 	=> 'UPLOAD SIPD',
			'judul'		=> 'UPLOAD SIPD',
			'deskripsi'	=> 'UPLOAD SIPD'
		);

		$this->template->views('utilitas/V_Sikd', $data);
	}

	public function getBulan()
	{
		$lccq 	= $this->input->post('q');
		$res = $this->M_Sikd->getBulan($lccq);
		echo json_encode($res);
	}

	public function getConfig()
	{
		return $this->M_Sikd->getConfig();
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
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kodesatkerskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">namasatkerskpd</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nama_pegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nip</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nik</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tanggal_lahir</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">alamat</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tipe_jabatan</td>
    			<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">eselon</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">golongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">pppk_pns</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nama_jabatan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">status_pernikahan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nip_pasangan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">is_pasangan_pns</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kode_bank</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nama_bank</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">npwp</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nomor_rekening_bank_pegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tipe_k</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_anak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_istri_suami</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_tanggungan</td>                    
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_gaji_pokok</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">perhitungan_suami_istri</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">perhitungan_anak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_keluarga</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_jabatan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_fungsional</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_gaji_tunjangan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_fungsional_umum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_beras</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_tunjangan_pph</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_pembulatan_gaji</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_iuran_jaminan_kesehatan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_iuran_jaminan_kecelakaan_kerja</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_iuran_jaminan_kematian</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangan_jaminan_hari_tua</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangan_jaminan_pensiun</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">iwp_1</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">belanja_iuran_simpanan_tapera</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunjangan_khusus_papua</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_potongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jumlah_ditransfer</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">mkg</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">pph_21</td>
    		</tr>";

    	$sql2="SELECT a.satkerja as kodeSatkerSKPD, 
				(SELECT nm_satkerja FROM satkerja WHERE satkerja = a.satkerja) as namaSatkerSKPD, 
				a.nama as nama_pegawai, a.nip,'' as nik, a.lahir as tanggal_lahir, '' as alamat,'NON STRUKTURAL' as tipe_jabatan,
				a.eselon, b.nm_golongan as golongan, 'PEGAWAI BULANAN' as pppk_pns, 
				CASE when a.eselon <> '' THEN (select nm_eselon from eselon where eselon=a.eselon) else 'NON ESELON' END as nama_jabatan, 
				CASE when a.stskawin = 1 THEN 'YA' else 'TIDAK' END as status_pernikahan,
				'' AS nip_pasangan,'' AS is_pasangan_pns, '014' as kode_bank,'BANK KALTIMTARA' as nama_bank,
				CASE when a.npwp <> '' then a.npwp else '000000000000000' END as npwp,a.rekening as nomor_rekening_bank_pegawai,
				a.status as tipe_k, a.anak as jumlah_anak,
				CASE when a.stskawin = 1 THEN 1 else 0 END as jumlah_istri_suami,
				((a.anak)+(CASE when a.stskawin = 1 THEN 1 else 0 END)) as jumlah_tanggungan,
				a.gapok as belanja_gaji_pokok, a.tistri as perhitungan_suami_istri, a.tanak as perhitungan_anak,
				(a.tistri + a.tanak) as belanja_tunjangan_keluarga,
				a.khusus as belanja_tunjangan_jabatan,	a.tfung as belanja_tunjangan_fungsional,	
				(a.iwp+a.askes+a.tabungan+a.pph+a.sewa+a.hutang+a.jkk+a.jkm)+(a.netto) as jumlah_gaji_tunjangan,
				a.umum as belanja_tunjangan_fungsional_umum,	a.beras as belanja_tunjangan_beras,
				a.pph as belanja_tunjangan_pph,	a.bulat as belanja_pembulatan_gaji,	a.askes as belanja_iuran_jaminan_kesehatan,
				a.jkk as belanja_iuran_jaminan_kecelakaan_kerja,	a.jkm as belanja_iuran_jaminan_kematian,	
				a.tht as tunjangan_jaminan_hari_tua,	0 as tunjangan_jaminan_pensiun,	a.iwp as iwp_1,
				a.tabungan as belanja_iuran_simpanan_tapera,	a.papua as tunjangan_khusus_papua,	
				(a.iwp+a.askes+a.tabungan+a.pph+a.sewa+a.hutang+a.jkk+a.jkm) as jumlah_potongan,	
				a.netto as jumlah_ditransfer,	a.masa_tahun as mkg,	a.pph as pph_21
				from public.p3k_$periode a INNER JOIN golongan b on a.golongan=b.golongan WHERE a.nip != '';";
			$query = $this->db->query($sql2);
			foreach ($query->result() as $row) {
				$ckodesatkerskpd = $row->kodesatkerskpd ;
				$cnamasatkerskpd = $row->namasatkerskpd ;
				$cnama_pegawai = $row->nama_pegawai;	
				$cnip = $row->nip;	
				$cnik = $row->nik;	
				$ctanggal_lahir = $row->tanggal_lahir;	
				$calamat = $row->alamat;	
				$ctipe_jabatan = $row->tipe_jabatan;	
				$ceselon = $row->eselon;	
				$cgolongan = $row->golongan;	
				$cpppk_pns = $row->pppk_pns;	
				$cnama_jabatan = $row->nama_jabatan;	
				$cstatus_pernikahan = $row->status_pernikahan;	
				$cnip_pasangan = $row->nip_pasangan;	
				$cis_pasangan_pns = $row->is_pasangan_pns;	
				$ckode_bank = $row->kode_bank;	
				$cnama_bank = $row->nama_bank;	
				$cnpwp = $row->npwp;	
				$cnomor_rekening_bank_pegawai = $row->nomor_rekening_bank_pegawai;	
				$ctipe_k = $row->tipe_k;	
				$cjumlah_anak = $row->jumlah_anak;	
				$cjumlah_istri_suami = $row->jumlah_istri_suami;	
				$cjumlah_tanggungan = $row->jumlah_tanggungan;	
				$cbelanja_gaji_pokok = $row->belanja_gaji_pokok;	
				$cperhitungan_suami_istri = $row->perhitungan_suami_istri;	
				$cperhitungan_anak = $row->perhitungan_anak;	
				$cbelanja_tunjangan_keluarga = $row->belanja_tunjangan_keluarga;	
				$cbelanja_tunjangan_jabatan = $row->belanja_tunjangan_jabatan;	
				$cbelanja_tunjangan_fungsional = $row->belanja_tunjangan_fungsional;	
				$cjumlah_gaji_tunjangan = $row->jumlah_gaji_tunjangan;	
				$cbelanja_tunjangan_fungsional_umum = $row->belanja_tunjangan_fungsional_umum;	
				$cbelanja_tunjangan_beras = $row->belanja_tunjangan_beras;	
				$cbelanja_tunjangan_pph = $row->belanja_tunjangan_pph;	
				$cbelanja_pembulatan_gaji = $row->belanja_pembulatan_gaji;	
				$cbelanja_iuran_jaminan_kesehatan = $row->belanja_iuran_jaminan_kesehatan;	
				$cbelanja_iuran_jaminan_kecelakaan_kerja = $row->belanja_iuran_jaminan_kecelakaan_kerja;	
				$cbelanja_iuran_jaminan_kematian = $row->belanja_iuran_jaminan_kematian;	
				$ctunjangan_jaminan_hari_tua = $row->tunjangan_jaminan_hari_tua;	
				$ctunjangan_jaminan_pensiun = $row->tunjangan_jaminan_pensiun;	
				$ciwp_1 = $row->iwp_1;	
				$cbelanja_iuran_simpanan_tapera = $row->belanja_iuran_simpanan_tapera;	
				$ctunjangan_khusus_papua = $row->tunjangan_khusus_papua;	
				$cjumlah_potongan = $row->jumlah_potongan;	
				$cjumlah_ditransfer = $row->jumlah_ditransfer;	
				$cmkg = $row->mkg;	
				$cpph_21 = $row->pph_21;

			$cRet .="
   			        <tr>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckodesatkerskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnamasatkerskpd</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnama_pegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">'$cnip</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnik</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctanggal_lahir</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$calamat</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctipe_jabatan</td>
		    			<td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ceselon</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cgolongan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpppk_pns</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnama_jabatan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cstatus_pernikahan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnip_pasangan</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cis_pasangan_pns</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckode_bank</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnama_bank</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnpwp</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnomor_rekening_bank_pegawai</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctipe_k</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_anak</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_istri_suami</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_tanggungan</td>                    
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_gaji_pokok</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cperhitungan_suami_istri</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cperhitungan_anak</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_keluarga</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_jabatan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_fungsional</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_gaji_tunjangan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_fungsional_umum</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_beras</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_tunjangan_pph</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_pembulatan_gaji</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_iuran_jaminan_kesehatan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_iuran_jaminan_kecelakaan_kerja</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_iuran_jaminan_kematian</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangan_jaminan_hari_tua</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangan_jaminan_pensiun</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ciwp_1</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbelanja_iuran_simpanan_tapera</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunjangan_khusus_papua</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_potongan</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjumlah_ditransfer</td>
		                <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cmkg</td>
		                <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpph_21</td>		                        
                	</tr>";
            }

    	$cRet .="</table>";
		$data['prev']= $cRet;
		$judul  = 'Sipd_'.$periode;
		header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename= $judul.xls");
        $this->load->view('transaksi/excel', $data);
 	}
	
	
 

}


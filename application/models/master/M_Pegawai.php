<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pegawai extends CI_Model {

	public function  tanggal_ind($tgl){
		$tahun  =  substr($tgl,0,4);
		$bulan  = substr($tgl,5,2);
		$tanggal  =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	public function get_statuskawin($lccq){
		$sql	= "SELECT kode,nama_statuskawin FROM public.mkawin order by kode ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function get_kodebantu($lccq){
		$sql	= "SELECT kode,nama_bantu FROM public.mbantu order by kode ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function get_agama($lccq){
		$sql	= "SELECT kode,nama_agama FROM public.magama order by kode ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function get_satker($lccq){
		$sql	= "SELECT satkerja,nm_satkerja FROM public.satkerja where satkerja not in('001','002','003') order by satkerja ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function getUnit($lccq,$satkerja){
		$sql	= "SELECT unit,nm_unit FROM public.unitkerja WHERE satkerja='$satkerja' order by unit";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_gol($lccq){
		$sql	= "SELECT CAST(golongan AS int) as golongan, nm_golongan,tnpapua as umum FROM public.golongan ORDER BY golongan";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_masakerja($lccq,$golongan){
		$sql	= "SELECT tahun,gapok FROM public.masakerja where golongan ='$golongan' order by tahun ASC ";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_eselon($lccq){
		$sql	= "SELECT eselon,nm_eselon,jumlah FROM public.eselon order by eselon";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_fungsional($lccq,$golongan){
		$sql	= "SELECT kd_fung,jumlah FROM public.fungsional where golongan ='$golongan' order by kd_fung";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_khusus($lccq){
		$sql	= "SELECT kd_khusus,uraian,tnkhusus FROM public.mtunj_khusus order by kd_khusus";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_pensiun($lccq){
		$sql	= "SELECT umur FROM public.mpensiun order by umur";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_bulan($lccq){
		$sql	= "SELECT n_bulan,nama_bulan FROM public.bulan";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function load_header($key) {
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = '';
		$limit = "ORDER BY a.nama ASC LIMIT $rows OFFSET $offset";
		if($key!=''){
			$where = "where (upper(a.nip) like upper('%$key%') or upper(a.nama) like upper('%$key%'))";	
			$limit = "";	
		}
		
		$sql = "SELECT count(*) as tot from public.pegawai a $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "SELECT a.*,b.nm_satkerja,(select nm_unit from unitkerja where satkerja=a.satkerja and unit=a.unit) as nm_unit,
        (select nm_golongan from golongan where golongan=a.golongan) as nama_golongan from public.pegawai a 
		inner join public.satkerja b on a.satkerja=b.satkerja $where $limit";
				
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
				'id' 				=> $ii,        
				'nip' 				=> $resulte['nip'],
				'nip_lama' 			=> $resulte['nip_lama'],
				'nama' 				=> $resulte['nama'],
				'npwp' 				=> $resulte['npwp'],
				'nokartu' 			=> $resulte['nokartu'],
				'seks' 				=> $resulte['seks'],
				'kota' 				=> $resulte['kota'],
				'lahir' 			=> $resulte['lahir'],
				'agama' 			=> $resulte['agama'],
				'stskawin' 			=> $resulte['stskawin'],
				'anak' 				=> $resulte['anak'],
				'satkerja' 			=> $resulte['satkerja'],
				'nm_satkerja' 		=> $resulte['nm_satkerja'],
				'unit' 				=> $resulte['unit'],
				'nm_unit' 			=> $resulte['nm_unit'], 
				'golongan' 			=> $resulte['golongan'],
				'nama_golongan'		=> $resulte['nama_golongan'],
				'masa_tahun' 		=> $resulte['masa_tahun'],
				'masa_bulan' 		=> $resulte['masa_bulan'],
				'gapok' 			=> number_format($resulte['gapok'],2,'.',','), 
				'gapok1' 			=> $resulte['gapok'], 
				'tistri' 			=> number_format($resulte['tistri'],2,'.',','),
				'tanak' 			=> number_format($resulte['tanak'],2,'.',','), 
				'tpp' 				=> number_format($resulte['tpp'],2,'.',','),
				'eselon' 			=> $resulte['eselon'],
				'tstruk' 			=> number_format($resulte['tstruk'],2,'.',','),
				'tstruk1' 			=> $resulte['tstruk'],
				'kd_fung' 			=> $resulte['kd_fung'],
				'tfung' 			=> number_format($resulte['tfung'],2,'.',','),
				'tfung1' 			=> $resulte['tfung'],
				'kd_khusus' 		=> $resulte['kd_khusus'],
				'khusus' 			=> number_format($resulte['khusus'],2,'.',','), 
				'khusus1' 			=> $resulte['khusus'],
				'umum' 				=> number_format($resulte['umum'],2,'.',','),
				'umum1' 			=> $resulte['umum'],
				'bulat' 			=> number_format($resulte['bulat'],2,'.',','),
				'beras' 			=> number_format($resulte['beras'],2,'.',','),
				'askes' 			=> number_format($resulte['askes'],2,'.',','),
				'jkk' 				=> number_format($resulte['jkk'],2,'.',','),
				'jkm' 				=> number_format($resulte['jkm'],2,'.',','),
				'bruto' 			=> number_format($resulte['bruto'],2,'.',','),
				'iwp' 				=> number_format($resulte['iwp'],2,'.',','),
				'tht' 				=> number_format($resulte['tht'],2,'.',','),
				'netto' 			=> number_format($resulte['netto'],2,'.',','),
				'disc' 				=> number_format($resulte['disc'],2,'.',','),
				'pensiun' 			=> $resulte['pensiun'],
				'stspegawai' 		=> $resulte['stspegawai'],
				'kdguru' 			=> $resulte['kdguru'],
				'sk_fung' 			=> $resulte['sk_fung'],
				'tdt' 				=> number_format($resulte['tdt'],2,'.',','),
				'kdbantu' 			=> $resulte['kdbantu'],
				'ket' 				=> $resulte['ket'],
				'rekening' 			=> $resulte['rekening'],
				'kd_beras' 			=> $resulte['kd_beras'],
				'sk_jab' 			=> $resulte['sk_jab'],
				'tmt_pns' 			=> $resulte['tmt_pns'],
				'tmt_pangkat' 		=> $resulte['tmt_pangkat'],
				'tmt_berkala' 		=> $resulte['tmt_berkala'],
				'sewa' 				=> number_format($resulte['sewa'],2,'.',','),
				'tunggakan' 		=> number_format($resulte['tunggakan'],2,'.',','),
				'tabungan' 			=> number_format($resulte['tabungan'],2,'.',','),
				'hutang' 			=> number_format($resulte['hutang'],2,'.',','),
				'lain' 				=> number_format($resulte['lain'],2,'.',','),
				'pph' 				=> number_format($resulte['pph'],2,'.',','),
				'skorsing' 			=> $resulte['skorsing'],
				'kd_daerah' 		=> $resulte['kd_daerah'],
				'kd_pil' 			=> $resulte['kd_pil'],
				'photo' 			=> $resulte['photo'] 
				);
            $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result;
	}

	function hapus($post){
		$kode = htmlspecialchars($post['nip'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->where('nip', $val)
								->delete('public.pegawai');
				}
			
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	function saveData($post){
		$no_nip_lama 	= $post['no_nip_lama'];
		$no_nip 		= $post['no_nip'];		
		$nama 			= $post['nama'];
		$kartu 			= $post['kartu'];
		$tempat 		= $post['tempat'];
		$agama 			= $post['agama'];
		$status_kawin 	= $post['status_kawin'];
		$j_anak 		= $post['j_anak'];
		$satuan_kerja 	= $post['satuan_kerja'];
		$unit_kerja 	= $post['unit_kerja'];
		$gol 			= $post['gol'];
		$masa_kerja1 	= $post['masa_kerja1'];
		$masa_kerja2 	= $post['masa_kerja2'];
		$t_struktural 	= $post['t_struktural'];
		$k_bantu 		= $post['k_bantu'];
		$gapok 			= $post['gapok'];
		$n_struktural 	= $post['n_struktural'];
		$n_fungsional 	= $post['n_fungsional'];
		$n_khusus 		= $post['n_khusus'];
		$umum 			= $post['umum'];
		$sewa_rumah 	= $post['sewa_rumah'];
		$taperum 		= $post['taperum'];
		$h_pembayaran 	= $post['h_pembayaran'];
		$pot_lain 		= $post['pot_lain'];
		$k_perubahan 	= $post['k_perubahan'];
		$norek_bank 	= $post['norek_bank'];
		$batas_pensiun 	= $post['batas_pensiun'];
		$skorsing 		= $post['skorsing'];
		$t_fungsional 	= $post['t_fungsional'];
		$t_khusus 		= $post['t_khusus'];
		//$t_terpencil 	= $post['t_terpencil'];
		$npwp 			= $post['npwp'];
		$tgl_lahir 		= $post['tgl_lahir'];
		$tgl_pns 		= $post['tgl_pns'];
		$tgl_kepangkatan= $post['tgl_kepangkatan'];
		$tgl_berkala 	= $post['tgl_berkala'];
		$tgl_jabatan 	= $post['tgl_jabatan'];
		$tgl_fungsional = $post['tgl_fungsional'];
		$jenis_kelamin 	= $post['jenis_kelamin'];
		$s_pegawai1 	= $post['s_pegawai1'];
		$s_pegawai2 	= $post['s_pegawai2'];
		$tunj_beras 	= $post['tunj_beras'];
		$s_pegawai3 	= $post['s_pegawai3'];
		$pilihan 		= $post['pilihan'];
		$tistri 		= $post['tistri'];
		$tanak 			= $post['tanak'];
		$askes 			= $post['askes'];
		$jkk 			= $post['jkk'];
		$jkm 			= $post['jkm'];
		$status 		= $post['status'];
		$tunggakan 		= $post['tunggakan'];
		$beras 			= $post['beras'];
		$iwp 			= $post['iwp'];
		$tht 			= $post['tht'];
		$papua 			= $post['papua'];
		$pph 			= $post['pph'];
		$disc 			= $post['disc'];
		$bulat 			= $post['bulat'];
		$bruto 			= $post['bruto'];
		$netto 			= $post['netto'];
		try {			
				$del = $this->db->where('nip',$post['no_nip'])
							->delete('public.pegawai');				

				if($del){

					$ck = $this->db->query("SELECT tmt_pns FROM public.riwayat_pegawai WHERE nip='$no_nip' and tmt_pns='$tgl_pns' ");
					if($ck->num_rows() == 0) {
						$query = "INSERT INTO public.riwayat_pegawai(nip,nama,tmt_pns,ket) VALUES('$no_nip','$nama','$tgl_pns','$k_perubahan')";
				 		$sql = $this->db->query($query);
					}

					$query = "INSERT INTO public.pegawai(nip_lama,nip,nama,nokartu,kota,agama,stskawin,anak,satkerja,unit,golongan,masa_tahun,masa_bulan,eselon,kdbantu,gapok,tstruk,tfung,
					sewa,tabungan,hutang,lain,ket,rekening,pensiun,skorsing,kd_fung,nip2,npwp,lahir,tmt_pns,tmt_pangkat,tmt_berkala,sk_jab,sk_fung,
					seks,stspegawai,kdguru,kd_beras,kd_daerah,tistri,tanak,tpp,kenaikan,tkespeg,askes,status,tunggakan,potongan,beras,iwp,papua,pph,disc,bulat,bruto,netto,khusus,kd_khusus,tht,jkk,jkm,umum,kd_pil)
					VALUES('$no_nip_lama','$no_nip','$nama','$kartu','$tempat','$agama','$status_kawin','$j_anak','$satuan_kerja','$unit_kerja','$gol','$masa_kerja1','$masa_kerja2',
					'$t_struktural','$k_bantu','$gapok','$n_struktural','$n_fungsional','$sewa_rumah','$taperum','$h_pembayaran','$pot_lain','$k_perubahan','$norek_bank','$batas_pensiun',
					'$skorsing','$t_fungsional','$no_nip','$npwp','$tgl_lahir','$tgl_pns','$tgl_kepangkatan','$tgl_berkala','$tgl_jabatan','$tgl_fungsional',
					'$jenis_kelamin','$s_pegawai1','$s_pegawai2','$tunj_beras','$s_pegawai3','$tistri','$tanak','0','0','0','$askes','$status','$tunggakan','$pot_lain','$beras',
					'$iwp','0','$pph','$disc','$bulat','$bruto','$netto','$n_khusus','$t_khusus','$tht','$jkk','$jkm','$umum','$pilihan')";
			 		$sql = $this->db->query($query); 
				}
			
				if ($sql) {
					return 1;
					$sql->free_result();
				} else {
					return 0;
				}

		} catch (Exception $e) {
			return 0;
		}
		
	}

	

}


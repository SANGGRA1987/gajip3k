<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lap_Pegawai extends CI_Model {

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

	public function get_nip($lccq){
		$sql	= "SELECT nip,nama FROM public.pegawai order by nama ";
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
		$sql	= "SELECT satkerja,nm_satkerja FROM public.satkerja order by satkerja ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function getUnit($lccq,$satkerja){
		$sql	= "SELECT unit,nm_unit FROM public.unitkerja WHERE satkerja='$satkerja' order by unit";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_gol($lccq){
		$sql	= "SELECT golongan,nm_golongan FROM public.golongan order by golongan";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_golongan($lccq){
		$sql	= "SELECT id,nama_golongan FROM master.golongan order by id";
		$query  = $this->db->query($sql);
		return $query->result_array();
		//$this->template->views('master/form_b_pegawai', $data);
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

	public function get_fungsional($lccq){
		$sql	= "SELECT distinct kd_fung,jumlah2 FROM public.fungsional order by kd_fung";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_pensiun($lccq){
		$sql	= "SELECT umur FROM public.mpensiun order by umur";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_bulan($lccq){
		$sql	= "SELECT n_bulan,nama_bulan FROM public.bulan order by n_bulan ASC ";
		$query  = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_skpd($lccq){
		$sql = "SELECT satkerja, nm_satkerja FROM public.satkerja  where satkerja not in('001','003','002')  order by satkerja";
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
				'gapok' 			=> number_format($resulte['gapok']), 
				'eselon' 			=> $resulte['eselon'],
				'tstruk' 			=> number_format($resulte['tstruk']),
				'kd_fung' 			=> $resulte['kd_fung'],
				'tfung' 			=> number_format($resulte['tfung']),
				'pensiun' 			=> $resulte['pensiun'],
				'stspegawai' 		=> $resulte['stspegawai'],
				'kdguru' 			=> $resulte['kdguru'],
				'sk_fung' 			=> $resulte['sk_fung'],
				'tdt' 				=> number_format($resulte['tdt']),
				'kdbantu' 			=> $resulte['kdbantu'],
				'desc' 				=> $resulte['desc'],
				'rekening' 			=> $resulte['rekening'],
				'kd_beras' 			=> $resulte['kd_beras'],
				'sk_jab' 			=> $resulte['sk_jab'],
				'tmt_pns' 			=> $resulte['tmt_pns'],
				'tmt_pangkat' 		=> $resulte['tmt_pangkat'],
				'tmt_berkala' 		=> $resulte['tmt_berkala'],
				'sewa' 				=> number_format($resulte['sewa']),
				'tunggakan' 		=> number_format($resulte['tunggakan']),
				'tabungan' 			=> number_format($resulte['tabungan']),
				'hutang' 			=> number_format($resulte['hutang']),
				'lain' 				=> number_format($resulte['lain']),
				'skorsing' 			=> $resulte['skorsing'],
				'kd_daerah' 		=> $resulte['kd_daerah'],
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

	

}


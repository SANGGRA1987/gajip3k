<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Keluarga extends CI_Model {
	
	function simpan_header($post,$status,$no_dok,$skpd){

		try {
			if($status!='detail'){				
				$ck = $this->db->query("SELECT no_dokumen FROM transaksi.trh_planbrg
                           WHERE no_dokumen = '$no_dok' and kd_uskpd='$skpd'");	
				if($ck->num_rows() == 0) {
					$this->db->insert('transaksi.trh_planbrg', $post);
						return 1;
				} else {
						return 0;
				}
			}else{
				$del = $this->db->where('no_dokumen',$post['no_dokumen'])
							->where('kd_uskpd',$post['kd_uskpd'])
							->delete('transaksi.trh_planbrg');
				if($del){
				$sql = $this->db->insert('transaksi.trh_planbrg', $post);
				}
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
	
	function simpan_detail($post,$nip,$status){

		try {
			if($status!='detail'){		
				$i=0;
					foreach($post as $row) {							
						$filter_data = array(
							"nip" => htmlspecialchars($nip, ENT_QUOTES),
							"nama_kel" => htmlspecialchars($row->nama_kel, ENT_QUOTES),
							"status_hubungan" => htmlspecialchars($row->status_hubungan, ENT_QUOTES),
							"tgl_lahir" => htmlspecialchars($row->tgl_lahir, ENT_QUOTES),
							"pekerjaan" => htmlspecialchars($row->pekerjaan, ENT_QUOTES),
							"pendidikan" => htmlspecialchars($row->pendidikan, ENT_QUOTES),
							"tgl_didik" => htmlspecialchars($row->tgl_didik, ENT_QUOTES),
							"keterangan" => htmlspecialchars($row->keterangan, ENT_QUOTES),
							"tunjangan" => str_replace(array(','), array(''), $row->tunjangan)
						);
						$sql = $this->db->insert('public.ms_keluarga', $filter_data);
						$i++;
					}
			}else{
				$del = $this->db->where('nip',$nip)
								->delete('public.ms_keluarga');
				if($del){
					$i=0;
					foreach($post as $row) {							
						$filter_data = array(
							"nip" => htmlspecialchars($nip, ENT_QUOTES),
							"nama_kel" => htmlspecialchars($row->nama_kel, ENT_QUOTES),
							"status_hubungan" => htmlspecialchars($row->status_hubungan, ENT_QUOTES),
							"tgl_lahir" => htmlspecialchars($row->tgl_lahir, ENT_QUOTES),
							"pekerjaan" => htmlspecialchars($row->pekerjaan, ENT_QUOTES),
							"pendidikan" => htmlspecialchars($row->pendidikan, ENT_QUOTES),
							"tgl_didik" => htmlspecialchars($row->tgl_didik, ENT_QUOTES),
							"keterangan" => htmlspecialchars($row->keterangan, ENT_QUOTES),							
							"tunjangan" => str_replace(array(','), array(''), $row->tunjangan)
						);
						$sql = $this->db->insert('public.ms_keluarga', $filter_data);
						$i++;
					}					
				}
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
	
	function ubah($post){
		$object = array(
			'kd_comp'	=> htmlspecialchars($post['kd_comp'], ENT_QUOTES),
			'nm_comp'	=> htmlspecialchars($post['nm_comp'], ENT_QUOTES),
			'bentuk'	=> htmlspecialchars($post['bentuk'], ENT_QUOTES),
			'alamat'	=> htmlspecialchars($post['alamat'], ENT_QUOTES),
			'pimpinan'	=> htmlspecialchars($post['pimpinan'], ENT_QUOTES),
			'kd_bank'	=> htmlspecialchars($post['kd_bank'], ENT_QUOTES),
			'rekening'	=> htmlspecialchars($post['rekening'], ENT_QUOTES),
		);

		$sql = $this->db->where('kd_comp', $object['kd_comp'])
						->update('mcompany', $object);

		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return 0;
		}		
	}
	
	function hapus($post){
		$kd 	= explode("#",$post['nip']);
		$jml	= count($kd);
		//
		try{
			if($jml>0){				
				foreach($kd as $idx=>$val){
				$sql = $this->db->where('nip', $val)
							->delete('public.ms_keluarga');
							
				}
				return 1;
				$sql->free_result();									
			}					
		}catch(Exception $e){
			return 0;
		}		
	}

	public function ambil_bank($param)
	{
		$sql = "SELECT kode, nama FROM mbank where upper(kode) like upper('%$param%') or upper(nama) like upper('%$param%') order by kode";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(
	            'id' => $ii,        
	            'kd_bank' => $resulte['kode'],  
	            'nm_bank' => $resulte['nama']
            );	
            $ii++;
        }
        return $result;
        $query1->free_result();
	}

	public function load_keluarga($param)
	{
		$nip 	= $param['nip'];
		
        $sql = "SELECT a.*,b.nama,b.anak FROM public.ms_keluarga a INNER JOIN public.pegawai b ON a.nip=b.nip WHERE a.nip = '$nip'";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        {            
            $result[] = array(                                
                'nip'    	=> $resulte['nip'],                      
                'nama'      => $resulte['nama'],                     
                'anak'      => $resulte['anak'],
                'nama_kel'  => $resulte['nama_kel'],
                'status_hubungan'    => $resulte['status_hubungan'],
                'tgl_lahir' => $resulte['tgl_lahir'],
                'pekerjaan' => $resulte['pekerjaan'],
                'pendidikan' => $resulte['pendidikan'],         
                'tgl_didik' => $resulte['tgl_didik'],                        
                'keterangan' => $resulte['keterangan'],                    
                'tunjangan'  => $resulte['tunjangan'] 				
            );
            $ii++;
        }           
        return $result; 
	}


	public function getNIP()
	{
		
        $lccr 	= strtoupper($this->input->post('q'));
		$sql 	= $this->db->query("SELECT nip,nama,anak from pegawai where nip not in (select nip from ms_keluarga GROUP BY nip) and 
				(upper(nip) like '%$lccr%' or upper(nama) like '%$lccr%') order by nama");						
		
		$res 	= array();
		$li 	= 0;
		foreach ($sql->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'nip'	=> $key['nip'],
				'nama'	=> $key['nama'],
				'anak'	=> $key['anak']
			);
			$li++;
		}
		return $res;
		$sql->free_result();
	}

	public function getHub($param){        
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nm_hubungan) like upper('%$lccr%')"; 
        }


		$sql	= "SELECT kd_hubungan, nm_hubungan FROM ms_hubungan $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_hubungan' => $key['kd_hubungan'],  
                'nm_hubungan' => $key['nm_hubungan'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}
	
	public function getJenis($param)
	{
		$kel  	= $param['kd'];
		$lccq 	= $param['lccq'];
				
		if ($kel != '') {
			if($kel=='13'){
			$whr = "LEFT(kd_brg, 2) = '$kel' AND LENGTH(kd_brg)='3' AND ";
			}else{
			$whr = "LEFT(kd_brg, 2) = '$kel' AND kd_brg='153' AND ";
			}
		} else {
			$whr = '';
		}				
		
		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE $whr (upper(kd_brg) like upper('%$lccq%') 
		or upper(uraian) like upper('%$lccq%')) order by kd_brg";
		$query = $this->db->query($sql);
		$data = array();
		$li = 0;		
		foreach ($query->result_array() as $key) {
			$data[] = array(
				'id'		=> $li,
				'jenis'		=> $key['kd_brg'],
				'nm_jenis'	=> $key['uraian']
			);
			$li++;
		}
		return $data;
		$sql->free_result();
	}
	
	

	public function getBarang($param)
	{
		$jen  	= $param['kd'];
		$lccr  = strtoupper($this->input->post('q'));
		$lccq 	= strtoupper($param['lccq']);	

		$sql ="SELECT kd_brg,uraian FROM mbarang 
		WHERE LENGTH(kd_brg)='12' 
		AND LEFT(kd_brg, 3) = '$jen' 
		AND (upper(kd_brg) like upper('%$lccr%') or upper(uraian) like upper('%$lccr%'))
		ORDER BY kd_brg LIMIT 100 OFFSET 0";//		
		$query = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'kd_brg' 	=> $key['kd_brg'],  
                'nm_brg' 	=> $key['uraian']  
			);
			$li++;
		}

		return $res;
		$query->free_result();
	}
	
	public function max_number($param)
	{
		$oto   = $this->session->userdata('oto');
		$skpd  = $param['skpd'];
		$kolom = $param['kolom'];
		$table = $param['table'];
		
		if($oto=='01'){
			$where = "";
		}elseif($oto=='02'){
			$where = "where kd_uskpd='$skpd'";
		}else{
			$where = "";
		}
		
		$query1 = $this->db->query("SELECT MAX($kolom) AS kode, MAX(id_lock) as id_lock FROM $table $where");  
        $result = array();
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(      
                'no_urut' => $resulte['kode'],
                'id_lock' => $resulte['id_lock']
            );
        }
        return $result;
        $query1->free_result();
	}

}

/* End of file M_Keluarga.php */
/* Location: ./application/models/perencanaan/M_Keluarga.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_spp_gaji extends CI_Model {

	public function getConfig()
	{
		$this->db->from('config');
		$query = $this->db->get();
		if ( $query->result() > 0 ) {

			foreach ( $query->result() as $key ) {
				$data = array(
					'nm_daerah' 		=> $key->cona,                                              					
					'nm_kepala' 		=> $key->kep,                                              					
					'nip1'				=> $key->nipkep,                                              					
					'nm_sekda' 			=> $key->nmsekda,
					'nip2' 				=> $key->nipsekda,
					'telepon' 			=> $key->phone,
					'alamat' 			=> $key->address
				);
			}

		} else {

			$data = 'Null';

		}
		$query->free_result();
		return $data;
	}
/*
	public function getsp2d()
	{
		$oto 	= $this->session->userdata('oto');
		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("select a.no_sp2d,a.no_spm,a.tgl_sp2d,a.tgl_spm from transaksi.trhsp2d a inner join public.satkerja b on left(a.kd_skpd,7)=b.satkerja order by a.no_sp2d");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'no_sp2d'	=> $key->no_sp2d,
					'tgl_sp2d'	=> $key->tgl_sp2d,
					'no_spm'	=> $key->no_spm,
					'tgl_spm'	=> $key->tgl_spm
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat sp2d'
			);
		}
		$query->free_result();
		return json_encode($data);
	}
*/
	
	public function getBulan()
	{
		$this->db->from('bulan');
		$query = $this->db->get();
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'	=> $key->n_bulan,
					'text'	=> $key->nama_bulan
				);
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat Bulan'
			);
		}

		$query->free_result();
		return json_encode($data);
	}	

	public function getTahun()
	{
		$query = $this->db->get('tahun');
		$n = 0;

		if ( count($query->result()) > 0 ) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'	=> $n,
					'text'	=> $key->tahun
				);
				$n++;
			}
		} 
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat Tahun'
			);
		}

		$query->free_result();
		return json_encode($data);
	}

	public function getSkpd()
	{
		$oto 	= $this->session->userdata('oto');
		$skpd 	= $this->session->userdata('kd_skpd');
		if($oto=='01'){
			$and = "";
		}elseif($oto=='02'){
			$and = "and satkerja='$skpd'";
		}else{
			$and = "";
		}
		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("select * from satkerja 
		where satkerja like '%$lccr%' $and order by satkerja");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'kd_skpd'	=> $key->satkerja,
					'nm_skpd'	=> $key->nm_satkerja
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat SKPD'
			);
		}
		$query->free_result();
		return json_encode($data);
	}

	public function getUnitSkpd($param)
	{
		$this->db->from('munit')
				 ->where('kd_skpd', $param)
				 ->order_by('kd_skpd', 'asc');
		$query = $this->db->get();
		$n = 0;
		if ( $query->result() > 0 ) 
		{
			foreach ( $query->result() as $key ) {
				$data[] = array(
					'id'		=> $n,
					'kd_uskpd'	=> $key->kd_unit,
					'nm_uskpd'	=> $key->nm_unit
				);
				$n++;
			}
		}
		else
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Kosong'
			);
		}
		$query->free_result();
		return json_encode($data);
	}

	

  	public 	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}



	public function cetakspp($param)
	{
		if ( $param['jenisCetak'] == 0) 
		{
			$xy = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'QQ')
					 ->where('skpd', $param['skpd']);
			$csqlttdpa = $this->db->get();
			foreach ($csqlttdpa->result() as $key) {
				$data[] = array(
					'nippa'	 	=> $key->nip,
					'namapa'	=> $key->nama,
					'jabatanpa'	=> $key->jabatan
				);
				$xy++;
			}

			if ($xy == 0 ) 
			{
				$data[] = array(
					'nippa'      =>'Belum Ada NIP',
	                'namapa'     =>'Belum Ada Nama',
	                'jabatanpa'  =>'Belum Ada Jabatan',
				);
			}

			$yx = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'BK')
					 ->where('skpd', $param['skpd']);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nipbk' 	=> $key->nip,
                	'namabk'	=> $key->nama,
                	'jabatanbk' => $key->jabatan,
				);
                $yx++;        
			}

			if( $yx == 0 ){
                $data[] = array(
					'nipbk'      =>'Belum Ada NIP',
                	'namabk'     =>'Belum Ada Nama',
                	'jabatanbk'  =>'Belum Ada Jabatan',
				);
            }

            // $final_data['print'] = $data;
            return $data;
		} 
		elseif ( $param['jenisCetak'] == '1' ) 
		{
			$xy = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'QQ')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['nm_skpd']);
			$csqlttdpa = $this->db->get();
			foreach ($csqlttdpa->result() as $key) {
				$data[] = array(
					'nippa'	 	=> $key->nip,
					'namapa'	=> $key->nama,
					'jabatanpa'	=> $key->jabatan
				);
				$xy++;
			}

			if ($xy == 0 ) 
			{
				$data[] = array(
					'nippa'      =>'Belum Ada NIP',
	                'namapa'     =>'Belum Ada Nama',
	                'jabatanpa'  =>'Belum Ada Jabatan',
				);
			}

			$yx = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'BK')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['nm_skpd']);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nipbk' 	=> $key->nip,
                	'namabk'	=> $key->nama,
                	'jabatanbk' => $key->jabatan,
				);
                $yx++;        
			}

			if( $yx == 0 ){
                $data[] = array(
					'nipbk'      =>'Belum Ada NIP',
                	'namabk'     =>'Belum Ada Nama',
                	'jabatanbk'  =>'Belum Ada Jabatan',
				);
            }
            return $data;
		} 
		else if ( $param['jenisCetak'] == '2' )
	 	{
			$xy = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'QQ')
					 ->where('skpd', $param['skpd']);
			$csqlttdpa = $this->db->get();
			foreach ($csqlttdpa->result() as $key) {
				$data[] = array(
					'nippa'	 	=> $key->nip,
					'namapa'	=> $key->nama,
					'jabatanpa'	=> $key->jabatan
				);
				$xy++;
			}

			if ($xy == 0 ) 
			{
				$data[] = array(
					'nippa'      =>'Belum Ada NIP',
	                'namapa'     =>'Belum Ada Nama',
	                'jabatanpa'  =>'Belum Ada Jabatan',
				);
			}

			$yx = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'BK')
					 ->where('skpd', $param['skpd']);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nipbk' 	=> $key->nip,
                	'namabk'	=> $key->nama,
                	'jabatanbk' => $key->jabatan,
				);
                $yx++;        
			}

			if( $yx == 0 ){
                $data[] = array(
					'nipbk'      =>'Belum Ada NIP',
                	'namabk'     =>'Belum Ada Nama',
                	'jabatanbk'  =>'Belum Ada Jabatan',
				);
            }
            return $data;
		}

	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_formb_rekap extends CI_Model {

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
					'thn' 				=> $key->thang,
					'kota' 				=> $key->kota,
					'alamat' 			=> $key->address,
					'periode' 			=> $key->periode
				);
			}

		} else {

			$data = 'Null';

		}
		$query->free_result();
		return $data;
	}

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
		$skpd 	= $this->session->userdata('satkerja');
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
					'satkerja'	=> $key->satkerja,
					'nm_satkerja'	=> $key->nm_satkerja
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat SATKERJA'
			);
		}
		$query->free_result();
		return json_encode($data);
	}
	public function getUnitSkpd($param)
	{
		$this->db->from('unitkerja')
				 ->where('satkerja', $param)
				 ->order_by('unit', 'asc');
		$query = $this->db->get();
		$n = 0;
		if ( $query->result() > 0 ) 
		{
			foreach ( $query->result() as $key ) {
				$data[] = array(
					'id'		=> $n,
					'kd_uskpd'	=> $key->unit,
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

	public function cetakLaporanBK($value='')
	{
		# code...
	}

	public function cetakLaporan($param)
	{
		if ( $param['jenisCetak'] == 0) 
		{
			$xy = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'QQ')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['unit']);
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
					 ->where('unit', $param['unit']);
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

            $ab = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'PDG')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['unit']);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nippdg' 	=> $key->nip,
                	'namapdg'	=> $key->nama,
                	'jabatanpdg' => $key->jabatan,
				);
                $ab++;        
			}

			if( $ab == 0 ){
                $data[] = array(
					'nippdg'      =>'Belum Ada NIP',
                	'namapdg'     =>'Belum Ada Nama',
                	'jabatanpdg'  =>'Belum Ada Jabatan',
				);
            }

            // $final_data['print'] = $data;
            return $data;
		} 
		elseif ( $param['jenisCetak'] == 1 ) 
		{
			$xy = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'QQ')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['unit']);
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
					 ->where('unit', $param['unit']);
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

            $ab = 0;
			$this->db->select('nip, nama, jabatan')
					 ->from('ttd')
					 ->where('ckey', 'PDG')
					 ->where('skpd', $param['skpd'])
					 ->where('unit', $param['unit']);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nippdg' 	=> $key->nip,
                	'namapdg'	=> $key->nama,
                	'jabatanpdg' => $key->jabatan,
				);
                $ab++;        
			}

			if( $ab == 0 ){
                $data[] = array(
					'nippdg'      =>'Belum Ada NIP',
                	'namapdg'     =>'Belum Ada Nama',
                	'jabatanpdg'  =>'Belum Ada Jabatan',
				);
            }

            // $final_data['print'] = $data;
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

/* End of file M_tanah.php */
/* Location: ./application/models/lap_kib/kib_tanah/M_tanah.php */
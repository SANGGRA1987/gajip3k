<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kartugaji extends CI_Model {

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
					'alamat' 			=> $key->address,
					'thang' 			=> $key->thang,
					'kota' 			=> $key->kota
				);
			}

		} else {

			$data = 'Null';

		}
		$query->free_result();
		return $data;
	}

	public function getpenghasilan()
	{		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("SELECT a.nip, a.nip_lama, a.nama, a.satkerja, b.nm_satkerja, a.unit, c.nm_unit
									from pegawai a INNER JOIN satkerja b on a.satkerja=b.satkerja 
									INNER JOIN unitkerja c on a.satkerja=c.satkerja and a.unit=c.unit
									where ((a.nip like '%$lccr%') or (a.nama like '%$lccr%'))
									ORDER BY a.nama");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'nip'		=> $key->nip,
					'nip_lama'	=> $key->nip_lama,
					'nama'		=> $key->nama,
					'satkerja' 	=> $key->satkerja,
					'nm_satkerja' => $key->nm_satkerja,
					'unit' 		=> $key->unit,
					'nm_unit' 	=> $key->nm_unit
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat Nip/Nama'
			);
		}
		$query->free_result();
		return json_encode($data);
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
		$skpd 	= $this->session->userdata('kd_skpd');
		if($oto=='01'){
			$and = "";
		}elseif($oto=='02'){
			$and = "and kd_skpd='$skpd'";
		}else{
			$and = "";
		}
		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("select * from mskpd 
		where kd_skpd like '%$lccr%' $and");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'kd_skpd'	=> $key->kd_skpd,
					'nm_skpd'	=> $key->nm_skpd
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
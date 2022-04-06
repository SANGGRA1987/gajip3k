<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_KGII extends CI_Model {

	public function getSkpd()
	{
		$oto 	= $this->session->userdata('oto');
		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("select satkerja,nm_satkerja from public.satkerja where (satkerja like '%$lccr%' or nm_satkerja like '%$lccr%') order by satkerja");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'			=> $n,
					'satkerja'		=> $key->satkerja,
					'nm_satkerja'	=> $key->nm_satkerja
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat Satkerja'
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

	/*public function getSkpd()
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
	}*/

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

	public function cetakLaporan($param)
	{
			$xy = 0;
			$this->db->select('ankep,nipankep')
					 ->from('config');
			$csqlttdpa = $this->db->get();
			foreach ($csqlttdpa->result() as $key) {
				$data[] = array(
					'nippa'	 	=> $key->nipankep,
					'namapa'	=> $key->ankep
				);
				$xy++;
			}

			if ($xy == 0 ) 
			{
				$data[] = array(
					'nippa'      =>'Belum Ada NIP',
	                'namapa'     =>'Belum Ada Nama'
				);
			}

			$yx = 0;
			$this->db->select('nip_bend,nama_bend')
					 ->from('satkerja')
					 ->where('satkerja', $param);
			$csqlttdbk = $this->db->get();
			foreach ($csqlttdbk->result() as $key ) {
				$data[] = array(
					'nipbk' 	=> $key->nip_bend,
                	'namabk'	=> $key->nama_bend
				);
                $yx++;        
			}

			if( $yx == 0 ){
                $data[] = array(
					'nipbk'      =>'Belum Ada NIP',
                	'namabk'     =>'Belum Ada Nama'
				);
            }
            return $data;
		

	}

}

/* End of file M_tanah.php */
/* Location: ./application/models/lap_kib/kib_tanah/M_tanah.php */
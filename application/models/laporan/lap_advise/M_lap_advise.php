<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lap_advise extends CI_Model {

	public function getConfig()
	{
		$this->db->from('config');
		$query = $this->db->get();
		if ( $query->result() > 0 ) {

			foreach ( $query->result() as $key ) {
				$data = array(
					'nm_daerah' 		=> $key->nm_daerah,                                              					
					'nm_kepala' 		=> $key->nm_kepala,                                              					
					'nip1'				=> $key->nip1,                                              					
					'nm_wkepala'		=> $key->nm_wkepala,
					'nip2' 				=> $key->nip2,
					'nm_sekda' 			=> $key->nm_sekda,
					'nip3' 				=> $key->nip3,
					'email' 			=> $key->email,
					'telepon' 			=> $key->telepon,
					'web' 				=> $key->web,
					'alamat' 			=> $key->alamat,
					'logo' 				=> $key->file
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
		$oto 	= $this->session->userdata('oto');
		
        $lccr 	= $this->input->post('q');
		$query 	= $this->db->query("select no_advise, tgl_advise, total from transaksi.trhadvise where no_advise like '%$lccr%' order by no_advise");
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'no_advise'	=> $key->no_advise,
					'tgl_advise'=> $key->tgl_advise,
					'total' 	=> $key->total,
					'total1' 	=> number_format($key->total,2,',','.')
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

}

/* End of file M_tanah.php */
/* Location: ./application/models/lap_kib/kib_tanah/M_tanah.php */
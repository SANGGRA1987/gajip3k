<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kartu_gaji13 extends CI_Model {	
	
	public function getBulan($param){        
		$lccr  = strtoupper($this->input->post('q'));
        $key   = "";
        if($lccr!=''){
        	$key ="where upper(nama_bulan) like upper('%$lccr%')"; 
        }


		$sql	= "SELECT n_bulan, nama_bulan FROM public.bulan $key";
		$query  = $this->db->query($sql);
		$res = array();
		$li = 0;
		foreach ($query->result_array() as $key) {
			$res[] = array(
				'id'		=> $li,
				'n_bulan' => $key['n_bulan'],  
                'nama_bulan' => $key['nama_bulan'],
			);
			$li++;
		}
		return $res;
		$query->free_result();
	}

	public function getConfig()
	{
		$this->db->from('config');
		$query = $this->db->get();
		if ( $query->result() > 0 ) {

			foreach ( $query->result() as $key ) {
				$data = array(
					'thn' 				=> $key->thang
				);
			}

		} else {

			$data = 'Null';

		}
		$query->free_result();
		return $data;
	}

}

/* End of file M_Keluarga.php */
/* Location: ./application/models/perencanaan/M_Keluarga.php */
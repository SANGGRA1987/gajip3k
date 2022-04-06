<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cetak_Lap extends CI_Model {
	
	public function laporan($tabelName, $data){
		$res = $this->db->insert($tabelName, $data);
		return $res;
	}
	
	


	

	
}

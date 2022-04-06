<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan extends CI_Model {

	public function InsertData($tabelName, $data){
		$res = $this->db->insert($tabelName, $data);
		return $res;
	}

	
}


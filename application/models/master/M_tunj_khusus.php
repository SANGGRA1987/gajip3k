<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_tunj_khusus extends CI_Model {
	
	
	function simpan($post){
		$kd_khusus = htmlspecialchars($post['kd_khusus'], ENT_QUOTES);
		$uraian = htmlspecialchars($post['uraian'], ENT_QUOTES);
		$tnkhusus = (double)filter_var($this->input->post('tnkhusus'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try {
			$sql=$this->db->query("insert into mtunj_khusus (kd_khusus,uraian,tnkhusus) values ('$kd_khusus','$uraian','$tnkhusus')");
			if($sql){
				return 1;
			}else{
				return 0;
			}
		}catch (Exception $e) {
			return 0;
		}
		
	}
	
	function ubah($post){
		$kd_khusus = htmlspecialchars($post['kd_khusus'], ENT_QUOTES);
		$uraian = htmlspecialchars($post['uraian'], ENT_QUOTES);
		$tnkhusus = (double)filter_var($this->input->post('tnkhusus'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try{
			$sql = $this->db->query("update mtunj_khusus set uraian='$uraian',tnkhusus='$tnkhusus' where kd_khusus='$kd_khusus'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$kd_khusus = htmlspecialchars($post['kd_khusus'], ENT_QUOTES);
		$ex	  = explode("#", $kd_khusus);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM mtunj_khusus where kd_khusus='$val'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
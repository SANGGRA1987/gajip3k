<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_eselon extends CI_Model {
	
	
	function simpan($post){
		$eselon = htmlspecialchars($post['eselon'], ENT_QUOTES);
		$nm_eselon = htmlspecialchars($post['nm_eselon'], ENT_QUOTES);
		//$jumlah = htmlspecialchars($post['jumlah'], ENT_QUOTES);
	    $jumlah = (double)filter_var($this->input->post('jumlah'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		try {
			$sql=$this->db->query("insert into eselon (eselon,nm_eselon,jumlah,golongan) values ('$eselon','$nm_eselon','$jumlah','$golongan')");
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
		$eselon = htmlspecialchars($post['eselon'], ENT_QUOTES);
		$nm_eselon = htmlspecialchars($post['nm_eselon'], ENT_QUOTES);
		//$jumlah = htmlspecialchars($post['jumlah'], ENT_QUOTES);
		$jumlah = (double)filter_var($this->input->post('jumlah'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		try{
			$sql = $this->db->query("update eselon set nm_eselon='$nm_eselon',jumlah='$jumlah',golongan='$golongan' where eselon='$eselon'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$eselon = htmlspecialchars($post['eselon'], ENT_QUOTES);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$ex	  = explode("#", $eselon);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM eselon where eselon='$val' and golongan='$golongan'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
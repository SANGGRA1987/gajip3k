<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_golongan extends CI_Model {
	
	
	function simpan($post){
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$nm_golongan = htmlspecialchars($post['nm_golongan'], ENT_QUOTES);
		//$tnpapua = htmlspecialchars($post['tnpapua'], ENT_QUOTES);

		$tnpapua = (double)filter_var($this->input->post('tnpapua'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try {
			$sql=$this->db->query("insert into golongan (golongan,nm_golongan,tnpapua) values ('$golongan','$nm_golongan','$tnpapua')");
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
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$nm_golongan = htmlspecialchars($post['nm_golongan'], ENT_QUOTES);
		//$tnpapua = htmlspecialchars($post['tnpapua'], ENT_QUOTES);
		$tnpapua = (double)filter_var($this->input->post('tnpapua'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try{
			$sql = $this->db->query("update golongan set nm_golongan='$nm_golongan',tnpapua='$tnpapua' where golongan='$golongan'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$ex	  = explode("#", $golongan);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM golongan where golongan='$val'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
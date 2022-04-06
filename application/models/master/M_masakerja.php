<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_masakerja extends CI_Model {
	
	
	function simpan($post){
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$tahun = htmlspecialchars($post['tahun'], ENT_QUOTES);
		$gapok = (double)filter_var($this->input->post('gapok'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try {
			$sql=$this->db->query("insert into masakerja (golongan,tahun,gapok) values ('$golongan','$tahun','$gapok')");
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
		$tahun = htmlspecialchars($post['tahun'], ENT_QUOTES);
		$gapok = (double)filter_var($this->input->post('gapok'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		try{
			$sql = $this->db->query("update masakerja set gapok='$gapok' where golongan='$golongan' and tahun='$tahun'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$tahun = htmlspecialchars($post['tahun'], ENT_QUOTES);
		$ex	  = explode("#", $golongan);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM masakerja where golongan='$val' and tahun='$tahun'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_fungsional extends CI_Model {
	
	
	function simpan($post){
		$kd_fung = htmlspecialchars($post['kd_fung'], ENT_QUOTES);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$jumlah = (double)filter_var($this->input->post('jumlah'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$ket= htmlspecialchars($post['ket'], ENT_QUOTES);
		try {
			$sql=$this->db->query("insert into fungsional (kd_fung,golongan,jumlah,ket) values ('$kd_fung','$golongan','$jumlah','$ket')");
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
		$kd_fung = htmlspecialchars($post['kd_fung'], ENT_QUOTES);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$jumlah = (double)filter_var($this->input->post('jumlah'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$ket= htmlspecialchars($post['ket'], ENT_QUOTES);
		try{
			$sql = $this->db->query("update fungsional set golongan='$golongan',jumlah='$jumlah',ket='$ket' where kd_fung='$kd_fung'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$kd_fung = htmlspecialchars($post['kd_fung'], ENT_QUOTES);
		$golongan = htmlspecialchars($post['golongan'], ENT_QUOTES);
		$ex	  = explode("#", $kd_fung);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM fungsional where kd_fung='$val' and golongan='$golongan'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
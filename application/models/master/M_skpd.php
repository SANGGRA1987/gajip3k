<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_skpd extends CI_Model {
	
	
	function simpan($post){
		$kode = htmlspecialchars($post['satkerja'], ENT_QUOTES);
		$nama = htmlspecialchars($post['nmsatkerja'], ENT_QUOTES);
		$kota = htmlspecialchars($post['kota'], ENT_QUOTES);
		$jab_atasan = htmlspecialchars($post['jab_atasan'], ENT_QUOTES);
		$jab_atasan2 = htmlspecialchars($post['jab_atasan2'], ENT_QUOTES);
		$nama_atasan = htmlspecialchars($post['nama_atasan'], ENT_QUOTES);
		$nip_atasan = htmlspecialchars($post['nip_atasan'], ENT_QUOTES);
		$jab_bend = htmlspecialchars($post['jab_bend'], ENT_QUOTES);
		$nama_bend = htmlspecialchars($post['nama_bend'], ENT_QUOTES);
		$nip_bend = htmlspecialchars($post['nip_bend'], ENT_QUOTES);
		$jab_operator = htmlspecialchars($post['jab_operator'], ENT_QUOTES);
		$nama_operator = htmlspecialchars($post['nama_operator'], ENT_QUOTES);
		$nip_operator = htmlspecialchars($post['nip_operator'], ENT_QUOTES);
		$jab_bend2 = htmlspecialchars($post['jab_bend2'], ENT_QUOTES);
		$nama_bend2 = htmlspecialchars($post['nama_bend2'], ENT_QUOTES);
		$nip_bend2 = htmlspecialchars($post['nip_bend2'], ENT_QUOTES);
		try {
			$sql=$this->db->query("insert into satkerja (satkerja,nm_satkerja,kota,jab_atasan,jab_atasan2,nama_atasan,nip_atasan,jab_bend,nama_bend,nip_bend,jab_operator,nama_operator,nip_operator,jab_bend2,nama_bend2,nip_bend2) values ('$kode','$nama','$kota','$jab_atasan','$jab_atasan2','$nama_atasan','$nip_atasan','$jab_bend','$nama_bend','$nip_bend','$jab_operator','$nama_operator','$nip_operator','$jab_bend2','$nama_bend2','$nip_bend2')");
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
		$kode = htmlspecialchars($post['satkerja'], ENT_QUOTES);
		$nama = htmlspecialchars($post['nmsatkerja'], ENT_QUOTES);
		$kota = htmlspecialchars($post['kota'], ENT_QUOTES);
		$jab_atasan = htmlspecialchars($post['jab_atasan'], ENT_QUOTES);
		$jab_atasan2 = htmlspecialchars($post['jab_atasan2'], ENT_QUOTES);
		$nama_atasan = htmlspecialchars($post['nama_atasan'], ENT_QUOTES);
		$nip_atasan = htmlspecialchars($post['nip_atasan'], ENT_QUOTES);
		$jab_bend = htmlspecialchars($post['jab_bend'], ENT_QUOTES);
		$nama_bend = htmlspecialchars($post['nama_bend'], ENT_QUOTES);
		$nip_bend = htmlspecialchars($post['nip_bend'], ENT_QUOTES);
		$jab_operator = htmlspecialchars($post['jab_operator'], ENT_QUOTES);
		$nama_operator = htmlspecialchars($post['nama_operator'], ENT_QUOTES);
		$nip_operator = htmlspecialchars($post['nip_operator'], ENT_QUOTES);
		$jab_bend2 = htmlspecialchars($post['jab_bend2'], ENT_QUOTES);
		$nama_bend2 = htmlspecialchars($post['nama_bend2'], ENT_QUOTES);
		$nip_bend2 = htmlspecialchars($post['nip_bend2'], ENT_QUOTES);
		try{
			$sql = $this->db->query("update satkerja set nm_satkerja='$nama',kota='$kota',jab_atasan='$jab_atasan',jab_atasan2='$jab_atasan2',nama_atasan='$nama_atasan',nip_atasan='$nip_atasan',jab_bend='$jab_bend',nama_bend='$nama_bend',nip_bend='$nip_bend',jab_operator='$jab_operator',nama_operator='$nama_operator',nip_operator='$nip_operator',jab_bend2='$jab_bend2',nama_bend2='$nama_bend2',nip_bend2='$nip_bend2' where satkerja='$kode'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$satkerja = htmlspecialchars($post['satkerja'], ENT_QUOTES);
		$ex	  = explode("#", $satkerja);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM satkerja where satkerja='$val'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	
}

?>
<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_ttd extends CI_Model {
	
	
	function simpan($post){
		$kode = htmlspecialchars($post['skpd'], ENT_QUOTES);
		$nm_kode = htmlspecialchars($post['nm_skpd'], ENT_QUOTES);
		$unit = htmlspecialchars($post['unit'], ENT_QUOTES);
		$nm_unit = htmlspecialchars($post['nm_unit'], ENT_QUOTES);
		$jabatan = htmlspecialchars($post['jabatan'], ENT_QUOTES);
		$nama = htmlspecialchars($post['nama'], ENT_QUOTES);
		$nip = htmlspecialchars($post['nip'], ENT_QUOTES);
		$ckey = htmlspecialchars($post['ckey'], ENT_QUOTES);


		try {
			$sql=$this->db->query("insert into ttd (skpd,nm_skpd,unit,nm_unit,jabatan,nama,nip,ckey) 
				values ('$kode','$nm_kode','$unit','$nm_unit','$jabatan','$nama','$nip','$ckey')");
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
		$kode = htmlspecialchars($post['skpd'], ENT_QUOTES);
		$nm_kode = htmlspecialchars($post['nm_skpd'], ENT_QUOTES);
		$unit = htmlspecialchars($post['unit'], ENT_QUOTES);
		$nm_unit = htmlspecialchars($post['nm_unit'], ENT_QUOTES);
		$jabatan = htmlspecialchars($post['jabatan'], ENT_QUOTES);
		$nama = htmlspecialchars($post['nama'], ENT_QUOTES);
		$nip = htmlspecialchars($post['nip'], ENT_QUOTES);
		$ckey = htmlspecialchars($post['ckey'], ENT_QUOTES);

		try{
			$sql = $this->db->query("update ttd set skpd='$kode', nm_skpd='$nm_kode', unit='$unit', nm_unit='$nm_unit',jabatan='$jabatan',nama='$nama',ckey='$ckey'
				where nip='$nip'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$nip = htmlspecialchars($post['nip'], ENT_QUOTES);
	//	$unit = htmlspecialchars($post['unit'], ENT_QUOTES);
		$ex	  = explode("#", $nip);
		//$ex1	  = explode("#", $unit);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val ){
					$sql = $this->db->query("delete FROM ttd  where nip='$val'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}

	public function get_kode($lccq){
		$sql	= "SELECT ckey,nama_ckey FROM public.ms_kode_ttd order by nama_ckey ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	
}

?>
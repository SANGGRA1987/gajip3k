<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_otorisasi extends CI_Model {
	
	
	function simpan($id,$m01,$m02,$m03){
		try {
			$sql = $this->db->query("update ms_menu 
			set m01='$m01',m02='$m02',m03='$m03' where idmenu='$id'");
			if(!$sql){
			throw new Exception (' Error Database');
			}
			return 1;
		}catch (Exception $e) {
			return 0;
		}
		 
	}
	
	function conn_smkd($id){
		try {
			$sql = $this->db->query("update config set cad='$id'");
			if(!$sql){
			throw new Exception (' Error Database');
			}
			return 1;
		}catch (Exception $e) {
			return 0;
		}
		 
	}
	
	
}

?>
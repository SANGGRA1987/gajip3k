<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_pengguna extends CI_Model {
	
	
	function simpan($post){
		//otori:otori,user:username,pass:password,skpd:skpd,nmskpd:nm_skpd,uskpd:uskpd,nm_uskpd:nmuskpd,nmuser:nm_user
		//$kode = htmlspecialchars($post['kode'], ENT_QUOTES);
		//$nama = htmlspecialchars($post['nama'], ENT_QUOTES);
		try {
		$pgsql=$this->db->insert('public.muser', $post);
			if(!$pgsql){
			throw new Exception (' Error Database');
			}
			return 1;
		}catch (Exception $e) {
			return 0;
		}
		 
		 
		 
	}
	
	   public function addAccount($firstName, $lastName, $planId, $effectiveDate) {
        try {
            // start the transaction
            $this->pdo->beginTransaction();
 
            // insert an account and get the ID back
            $accountId = $this->insertAccount($firstName, $lastName);
 
            // add plan for the account
            $this->insertPlan($accountId, $planId, $effectiveDate);
 
            // commit the changes
            $this->pdo->commit();
        } catch (\PDOException $e) {
            // rollback the changes
            $this->pdo->rollBack();
            throw $e;
        }
    }
	
	
	
	function ubah($post){
		//kode:kode,otori:otori,user:username,pass:password,skpd:skpd,nmskpd:nm_skpd,uskpd:uskpd,nm_uskpd:nmuskpd,nmuser:nm_user,email:email
		$kode 	= htmlspecialchars($post['kode'], ENT_QUOTES);
		$user 	= htmlspecialchars($post['user'], ENT_QUOTES);
		$email 	= htmlspecialchars($post['email'], ENT_QUOTES);
		try{
			$sql = $this->db->query("update muser set username='$user' where kode='$kode'");
			return 1;
		}catch(Exception $e){
			return 0;
		}
		
	}
	
	function hapus($post){
		$kode = htmlspecialchars($post['kode'], ENT_QUOTES);
		$ex	  = explode("#", $kode);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->query("delete FROM muser where kode='$val'");
				}
			
			return 1;
			}
		}catch(Exception $e){
			return 0;
		}
		
	}
	
		public function getSkpd()
	{
		$this->db->from('mskpd')
				 ->order_by('kd_skpd', 'asc');
		$query = $this->db->get();
		$n = 0;
		if ($query->result() > 0) 
		{
			foreach ($query->result() as $key) {
				$data[] = array(
					'id'		=> $n,
					'kd_skpd'	=> $key->kd_skpd,
					'nm_skpd'	=> $key->nm_skpd
				);
				$n++;
			}
		}
		else 
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Tidak Terdapat SKPD'
			);
		}
		$query->free_result();
		return json_encode($data);
	}

	public function getUnitSkpd($param)
	{
		$this->db->from('munit')
				 ->where('kd_skpd', $param)
				 ->order_by('kd_skpd', 'asc');
		$query = $this->db->get();
		$n = 0;
		if ( $query->result() > 0 ) 
		{
			foreach ( $query->result() as $key ) {
				$data[] = array(
					'id'		=> $n,
					'kd_skpd'	=> $key->kd_unit,
					'nm_skpd'	=> $key->nm_unit
				);
				$n++;
			}
		}
		else
		{
			$data[] = array(
				'id'	=> '0',
				'text'	=> 'Kosong'
			);
		}
		$query->free_result();
		return json_encode($data);
	}
	
	
}

?>
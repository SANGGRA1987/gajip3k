<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Komponen_dev extends CI_Model {

	public function load_header() {
		
        $sql = "SELECT * from transaksi.utilitas_dev";
				
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
				'id' 		=> $ii,
				'beras_kg'	=> number_format($resulte['beras_kg'],2,'.',','),
				'beras_rp'	=> number_format($resulte['beras_rp'],2,'.',','),
				'iwp'		=> number_format($resulte['iwp'],2,'.',','),
				'potpens'	=> number_format($resulte['potpens'],2,'.',','),
				'tht'		=> number_format($resulte['tht'],2,'.',','),
				'ptkp'		=> number_format($resulte['ptkp'],2,'.',','),
				'askes'		=> number_format($resulte['askes'],2,'.',','),
				'ptkp2'		=> number_format($resulte['ptkp2'],2,'.',','),
				'jkk'		=> number_format($resulte['jkk'],2,'.',','),
				'jkm'		=> number_format($resulte['jkm'],2,'.',','),
				'istri'		=> number_format($resulte['istri'],2,'.',','),
				'anak'		=> number_format($resulte['anak'],2,'.',',')
				);
            $ii++;
        }
           
        $result["rows"] = $row; 
        return $result;
	}

	function saveData($post){		
		$beras_kg 	= $post['beras_kg'];
		$beras_rp 	= $post['beras_rp'];
		$iwp 		= $post['iwp'];
		$potpens 	= $post['potpens'];
		$tht 		= $post['tht'];
		$ptkp 		= $post['ptkp'];
		$askes 		= $post['askes'];
		$ptkp2 		= $post['ptkp2'];
		$jkk 		= $post['jkk'];
		$jkm 		= $post['jkm'];
		$istri 		= $post['istri'];
		$anak 		= $post['anak'];

				$query = "UPDATE transaksi.utilitas_dev SET 
					beras_kg	= '$beras_kg', 		
					beras_rp	= '$beras_rp', 		
					iwp			= '$iwp', 		
					potpens		= '$potpens', 		
					tht			= '$tht', 	
					ptkp		= '$ptkp', 	
					askes		= '$askes', 	
					ptkp2		= '$ptkp2', 	
					jkk			= '$jkk', 		
					jkm			= '$jkm', 		
					istri		= '$istri', 		
					anak		= '$anak'";
		 		$sql = $this->db->query($query); 
			
		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			} else {
				return 0;
			}

		} catch (Exception $e) {
			return 0;
		}
		
	}

	

}


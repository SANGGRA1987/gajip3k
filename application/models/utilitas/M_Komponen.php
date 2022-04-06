<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Komponen extends CI_Model {

	public function load_header() {
		
        $sql = "SELECT * from transaksi.utilitas";
				
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
				'id' 			=> $ii,
				'cpns1'			=> number_format($resulte['cpns1']),
				'cpns2'			=> number_format($resulte['cpns2']),
				'cpns3'			=> number_format($resulte['cpns3']),
				'cpns4'			=> number_format($resulte['cpns4']),
				'istri1'		=> number_format($resulte['istri1']),
				'istri2'		=> number_format($resulte['istri2']),
				'istri3'		=> number_format($resulte['istri3']),
				'istri4'		=> number_format($resulte['istri4']),
				'anak1'			=> number_format($resulte['anak1']),
				'anak2'			=> number_format($resulte['anak2']),
				'anak3'			=> number_format($resulte['anak3']),
				'anak4'			=> number_format($resulte['anak4']),
				'tpp1'			=> number_format($resulte['tpp1']),
				'tpp2'			=> number_format($resulte['tpp2']),
				'tpp3'			=> number_format($resulte['tpp3']),
				'tpp4'			=> number_format($resulte['tpp4']),
				'beras_kg1'		=> number_format($resulte['beras_kg1']),
				'beras_kg2'		=> number_format($resulte['beras_kg2']),
				'beras_kg3'		=> number_format($resulte['beras_kg3']),
				'beras_kg4'		=> number_format($resulte['beras_kg4']),
				'beras_rp1'		=> number_format($resulte['beras_rp1']),
				'beras_rp2'		=> number_format($resulte['beras_rp2']),
				'beras_rp3'		=> number_format($resulte['beras_rp3']),
				'beras_rp4'		=> number_format($resulte['beras_rp4']),
				'tdt1'			=> number_format($resulte['tdt1']),
				'tdt2'			=> number_format($resulte['tdt2']),
				'tdt3'			=> number_format($resulte['tdt3']),
				'tdt4'			=> number_format($resulte['tdt4']),
				'tirja1'		=> number_format($resulte['tirja1']),
				'tirja2'		=> number_format($resulte['tirja2']),
				'tirja3'		=> number_format($resulte['tirja3']),
				'tirja4'		=> number_format($resulte['tirja4']),
				'lain1'			=> number_format($resulte['lain1']),
				'lain2'			=> number_format($resulte['lain2']),
				'lain3'			=> number_format($resulte['lain3']),
				'lain4'			=> number_format($resulte['lain4']),
				'askes1'		=> number_format($resulte['askes1']),
				'askes2'		=> number_format($resulte['askes2']),
				'askes3'		=> number_format($resulte['askes3']),
				'askes4'		=> number_format($resulte['askes4']),
				'tirja11'		=> number_format($resulte['tirja11']),
				'tirja12'		=> number_format($resulte['tirja12']),
				'tirja13'		=> number_format($resulte['tirja13']),
				'tirja14'		=> number_format($resulte['tirja14']),
				'tirja21'		=> number_format($resulte['tirja21']),
				'tirja22'		=> number_format($resulte['tirja22']),
				'tirja23'		=> number_format($resulte['tirja23']),
				'tirja24'		=> number_format($resulte['tirja24']),
				'tirja31'		=> number_format($resulte['tirja31']),
				'tirja32'		=> number_format($resulte['tirja32']),
				'tirja33'		=> number_format($resulte['tirja33']),
				'tirja34'		=> number_format($resulte['tirja34']),
				'tirja41'		=> number_format($resulte['tirja41']),
				'tirja42'		=> number_format($resulte['tirja42']),
				'tirja43'		=> number_format($resulte['tirja43']),
				'tirja44'		=> number_format($resulte['tirja44']),
				'tirja45'		=> number_format($resulte['tirja45']),
				'iwp1'			=> number_format($resulte['iwp1']),
				'iwp2'			=> number_format($resulte['iwp2']),
				'iwp3'			=> number_format($resulte['iwp3']),
				'iwp4'			=> number_format($resulte['iwp4']),
				'korpri1'		=> number_format($resulte['korpri1']),
				'korpri2'		=> number_format($resulte['korpri2']),
				'korpri3'		=> number_format($resulte['korpri3']),
				'korpri4'		=> number_format($resulte['korpri4']),
				'tabrumah1'		=> number_format($resulte['tabrumah1']),
				'tabrumah2'		=> number_format($resulte['tabrumah2']),
				'tabrumah3'		=> number_format($resulte['tabrumah3']),
				'tabrumah4'		=> number_format($resulte['tabrumah4']),
				'potjab1'		=> number_format($resulte['potjab1']),
				'potjab2'		=> number_format($resulte['potjab2']),
				'potjab3'		=> number_format($resulte['potjab3']),
				'potjab4'		=> number_format($resulte['potjab4']),
				'potpens1'		=> number_format($resulte['potpens1']),
				'potpens2'		=> number_format($resulte['potpens2']),
				'potpens3'		=> number_format($resulte['potpens3']),
				'potpens4'		=> number_format($resulte['potpens4']),
				'tht1'			=> number_format($resulte['tht1']),
				'tht2'			=> number_format($resulte['tht2']),
				'tht3'			=> number_format($resulte['tht3']),
				'tht4'			=> number_format($resulte['tht4']),
				'ptkp'			=> number_format($resulte['ptkp']),
				'ptkp2'			=> number_format($resulte['ptkp2'])
				);
            $ii++;
        }
           
        $result["rows"] = $row; 
        return $result;
	}

	function saveData($post){		
		$cpns1 		= $post['cpns1'];
		$cpns2 		= $post['cpns2'];
		$cpns3 		= $post['cpns3'];
		$cpns4 		= $post['cpns4'];
		$istri1 	= $post['istri1'];
		$istri2 	= $post['istri2'];
		$istri3 	= $post['istri3'];
		$istri4 	= $post['istri4'];
		$anak1 		= $post['anak1'];
		$anak2 		= $post['anak2'];
		$anak3 		= $post['anak3'];
		$anak4 		= $post['anak4'];
		$tpp1 		= $post['tpp1'];
		$tpp2 		= $post['tpp2'];
		$tpp3 		= $post['tpp3'];
		$tpp4 		= $post['tpp4'];
		$beras_kg1 	= $post['beras_kg1'];
		$beras_kg2 	= $post['beras_kg2'];
		$beras_kg3 	= $post['beras_kg3'];
		$beras_kg4 	= $post['beras_kg4'];
		$beras_rp1 	= $post['beras_rp1'];
		$beras_rp2 	= $post['beras_rp2'];
		$beras_rp3 	= $post['beras_rp3'];
		$beras_rp4 	= $post['beras_rp4'];
		$tdt1 		= $post['tdt1'];
		$tdt2 		= $post['tdt2'];
		$tdt3 		= $post['tdt3'];
		$tdt4 		= $post['tdt4'];
		$tirja1 	= $post['tirja1'];
		$tirja2 	= $post['tirja2'];
		$tirja3 	= $post['tirja3'];
		$tirja4 	= $post['tirja4'];
		$lain1 		= $post['lain1'];
		$lain2 		= $post['lain2'];
		$lain3 		= $post['lain3'];
		$lain4 		= $post['lain4'];
		$askes1 	= $post['askes1'];
		$askes2 	= $post['askes2'];
		$askes3 	= $post['askes3'];
		$askes4 	= $post['askes4'];
		$tirja11 	= $post['tirja11'];
		$tirja12 	= $post['tirja12'];
		$tirja13 	= $post['tirja13'];
		$tirja14 	= $post['tirja14'];
		$tirja21 	= $post['tirja21'];
		$tirja22 	= $post['tirja22'];
		$tirja23 	= $post['tirja23'];
		$tirja24 	= $post['tirja24'];
		$tirja31 	= $post['tirja31'];
		$tirja32 	= $post['tirja32'];
		$tirja33 	= $post['tirja33'];
		$tirja34 	= $post['tirja34'];
		$tirja41 	= $post['tirja41'];
		$tirja42 	= $post['tirja42'];
		$tirja43 	= $post['tirja43'];
		$tirja44 	= $post['tirja44'];
		$tirja45 	= $post['tirja45'];
		$iwp1 		= $post['iwp1'];
		$iwp2 		= $post['iwp2'];
		$iwp3 		= $post['iwp3'];
		$iwp4 		= $post['iwp4'];
		$korpri1 	= $post['korpri1'];
		$korpri2 	= $post['korpri2'];
		$korpri3 	= $post['korpri3'];
		$korpri4 	= $post['korpri4'];
		$tabrumah1 	= $post['tabrumah1'];
		$tabrumah2 	= $post['tabrumah2'];
		$tabrumah3 	= $post['tabrumah3'];
		$tabrumah4 	= $post['tabrumah4'];
		$potjab1 	= $post['potjab1'];
		$potjab2 	= $post['potjab2'];
		$potjab3 	= $post['potjab3'];
		$potjab4 	= $post['potjab4'];
		$potpens1 	= $post['potpens1'];
		$potpens2 	= $post['potpens2'];
		$potpens3 	= $post['potpens3'];
		$potpens4 	= $post['potpens4'];
		$tht1 		= $post['tht1'];
		$tht2 		= $post['tht2'];
		$tht3 		= $post['tht3'];
		$tht4 		= $post['tht4'];
		$ptkp 		= $post['ptkp'];
		$ptkp2 		= $post['ptkp2'];

				$query = "UPDATE transaksi.utilitas SET 
					cpns1		= '$cpns1', 		
					cpns2		= '$cpns2', 		
					cpns3		= '$cpns3', 		
					cpns4		= '$cpns4', 		
					istri1		= '$istri1', 	
					istri2		= '$istri2', 	
					istri3		= '$istri3', 	
					istri4		= '$istri4', 	
					anak1		= '$anak1', 		
					anak2		= '$anak2', 		
					anak3		= '$anak3', 		
					anak4		= '$anak4', 		
					tpp1		= '$tpp1', 		
					tpp2		= '$tpp2', 		
					tpp3		= '$tpp3', 		
					tpp4		= '$tpp4', 		
					beras_kg1	= '$beras_kg1', 	
					beras_kg2	= '$beras_kg2', 	
					beras_kg3	= '$beras_kg3', 	
					beras_kg4	= '$beras_kg4', 	
					beras_rp1	= '$beras_rp1', 	
					beras_rp2	= '$beras_rp2', 	
					beras_rp3	= '$beras_rp3', 	
					beras_rp4	= '$beras_rp4', 	
					tdt1		= '$tdt1', 		
					tdt2		= '$tdt2', 		
					tdt3		= '$tdt3', 		
					tdt4		= '$tdt4', 		
					tirja1		= '$tirja1', 	
					tirja2		= '$tirja2', 	
					tirja3		= '$tirja3', 	
					tirja4		= '$tirja4', 	
					lain1		= '$lain1', 		
					lain2		= '$lain2', 		
					lain3		= '$lain3', 		
					lain4		= '$lain4', 		
					askes1		= '$askes1', 	
					askes2		= '$askes2', 	
					askes3		= '$askes3', 	
					askes4		= '$askes4', 	
					tirja11		= '$tirja11', 	
					tirja12		= '$tirja12', 	
					tirja13		= '$tirja13', 	
					tirja14		= '$tirja14', 	
					tirja21		= '$tirja21', 	
					tirja22		= '$tirja22', 	
					tirja23		= '$tirja23', 	
					tirja24		= '$tirja24', 	
					tirja31		= '$tirja31', 	
					tirja32		= '$tirja32', 	
					tirja33		= '$tirja33', 	
					tirja34		= '$tirja34', 	
					tirja41		= '$tirja41', 	
					tirja42		= '$tirja42', 	
					tirja43		= '$tirja43', 	
					tirja44		= '$tirja44', 	
					tirja45		= '$tirja45', 	
					iwp1		= '$iwp1', 		
					iwp2		= '$iwp2', 		
					iwp3		= '$iwp3', 		
					iwp4		= '$iwp4', 		
					korpri1		= '$korpri1', 	
					korpri2		= '$korpri2', 	
					korpri3		= '$korpri3', 	
					korpri4		= '$korpri4', 	
					tabrumah1	= '$tabrumah1', 	
					tabrumah2	= '$tabrumah2', 	
					tabrumah3	= '$tabrumah3', 	
					tabrumah4	= '$tabrumah4', 	
					potjab1		= '$potjab1', 	
					potjab2		= '$potjab2', 	
					potjab3		= '$potjab3', 	
					potjab4		= '$potjab4', 	
					potpens1	= '$potpens1', 	
					potpens2	= '$potpens2', 	
					potpens3	= '$potpens3', 	
					potpens4	= '$potpens4', 	
					tht1		= '$tht1', 		
					tht2		= '$tht2', 		
					tht3		= '$tht3', 		
					tht4		= '$tht4', 		
					ptkp		= '$ptkp', 		
					ptkp2 		= '$ptkp2'";
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


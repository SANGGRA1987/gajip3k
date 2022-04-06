<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ADVISE extends CI_Model {

	public function loadHeader($key) {
		$result = array();
	    $row = array();
	    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;        
	    
	    if($key !=''){
			$cari  = "(upper(no_advise) like upper('%$key%'))";	
			$limit = "";	
			$where = " where $cari $limit ";
			}else{
			$limit  = "ORDER BY no_advise ASC LIMIT $rows OFFSET $offset";
			$where = "";
		}
	    
	    $sql = "SELECT count(*) as total from transaksi.trhadvise $where " ;
	    $query1 = $this->db->query($sql);
	    $total = $query1->row();
	    $result["total"] = $total->total; 
	    $query1->free_result();
	    
	    $sql = "SELECT * from transaksi.trhadvise $where $limit";
	    $query1 = $this->db->query($sql);       
	    $ii = 0;
	    foreach($query1->result_array() as $resulte)
	    { 
	     
	        $row[] = array(
	            'id' => $ii,        
	            'no_advise' => $resulte['no_advise'],
	            'tgl_advise' => $resulte['tgl_advise'],
	            'total1' => number_format($resulte['total'],2,'.',','),                                                     
	            'total' => $resulte['total']              
	            );
	        $ii++;
	    }
           
        $result["rows"] = $row; 
        return $result;
	}

	public function tanggal_ind($tgl){
		$tahun   =  substr($tgl,0,4);
		$bulan   = substr($tgl,5,2);
		$tanggal =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	function saveData($post,$status){
		$no_advise 		= $post['no_advise'];
		$tanggal 		= $post['tanggal'];
		$total 			= $post['total'];
		try {
			if($status!='detail'){

				$ck = $this->db->query("SELECT no_advise FROM transaksi.trhadvise
                           WHERE no_advise = '$no_advise'");

				if($ck->num_rows() == 0) {
					$query = "INSERT INTO transaksi.trhadvise(no_advise,tgl_advise,total)
					VALUES('$no_advise','$tanggal','$total')";
			 		$sql = $this->db->query($query);			 		
						return 1;
				} else {
						return 0;
				}

			}else{
				$del = $this->db->where('no_advise',$post['no_advise'])
							->delete('transaksi.trhadvise');				

				if($del){
					$query = "INSERT INTO transaksi.trhadvise(no_advise,tgl_advise,total)
					VALUES('$no_advise','$tanggal','$total')";
			 		$sql = $this->db->query($query);
				}
			}

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

	function simpan_detail($no_advise,$status,$post){		
		try {
			if($status!='detail'){
					foreach($post as $row) {							
						$filter_data = array(
							"no_advise" => htmlspecialchars($no_advise, ENT_QUOTES),
							"no_sp2d"   => htmlspecialchars($row->no_sp2d, ENT_QUOTES),
							"nospm"   	=> htmlspecialchars($row->nospm, ENT_QUOTES),
							"tgl_sp2d"  => htmlspecialchars($row->tgl_sp2d, ENT_QUOTES),
							"kd_skpd"  	=> htmlspecialchars($row->kd_skpd, ENT_QUOTES),
							"nm_skpd"  	=> htmlspecialchars($row->nm_skpd, ENT_QUOTES),
							"nilai"    	=> str_replace(array(',',''), array('',''),  $row->nilai)
						);
						$query = "INSERT INTO transaksi.trdadvise(no_advise,no_sp2d,no_spm,tgl_sp2d,kd_skpd,nm_skpd,nilai)
						VALUES('$no_advise','$row->no_sp2d','$row->nospm','$row->tgl_sp2d','$row->kd_skpd','$row->nm_skpd','$row->nilai')";
				 		$sql = $this->db->query($query);
					}
			}else{
				$del = $this->db->where('no_advise',$no_advise)
							->delete('transaksi.trdadvise');
				if($del){
					foreach($post as $row) {							
						$filter_data = array(
							"no_advise" => htmlspecialchars($no_advise, ENT_QUOTES),
							"no_sp2d"   => htmlspecialchars($row->no_sp2d, ENT_QUOTES),
							"nospm"   	=> htmlspecialchars($row->nospm, ENT_QUOTES),							
							"tgl_sp2d"  => htmlspecialchars($row->tgl_sp2d, ENT_QUOTES),
							"kd_skpd"  	=> htmlspecialchars($row->kd_skpd, ENT_QUOTES),
							"nm_skpd"  	=> htmlspecialchars($row->nm_skpd, ENT_QUOTES),
							"nilai"    => str_replace(array(',',''), array('',''),  $row->nilai)
						);
						$query = "INSERT INTO transaksi.trdadvise(no_advise,no_sp2d,no_spm,tgl_sp2d,kd_skpd,nm_skpd,nilai)
						VALUES('$no_advise','$row->no_sp2d','$row->nospm','$row->tgl_sp2d','$row->kd_skpd','$row->nm_skpd','$row->nilai')";
				 		$sql = $this->db->query($query);
					}	
				}
			}
			
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

	function hapus($post){
		$no_advise  = htmlspecialchars($post['no_advise'], ENT_QUOTES);
		$ex	    	= explode("#", $no_advise);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->where('no_advise', $val)
								->delete('transaksi.trhadvise');
					$sql = $this->db->where('no_advise', $val)
								->delete('transaksi.trdadvise');
				}		
				return 1;
				$sql->free_result();
			}
		}catch(Exception $e){
			return $cekk;
		}
		
	}

	public function load_detail($param)
	{
		$result = array();
	    $row = array();
	    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
	    $where = '';
		$limit = "order by left(no_sp2d,4) ASC LIMIT $rows OFFSET $offset";

		$nomor 	= $param['nomor'];
		$sql = "SELECT count(*) as tot from transaksi.trdadvise where no_advise = '$nomor' $where";
        $query1 = $this->db->query($sql);
        $total = $query1->row();
        $result["total"] = $total->tot; 

		$sql = "SELECT * from transaksi.trdadvise where no_advise = '$nomor' $where $limit";
	    $query1 = $this->db->query($sql);       
	    $ii = 0;
	    foreach($query1->result_array() as $resulte)
	    {
	        $row[] = array(
	            'id' => $ii,        
	            'no_sp2d' => $resulte['no_sp2d'],
	            'tgl_sp2d' => $resulte['tgl_sp2d'],
	            'nospm' => $resulte['no_spm'],
	            'nmrekan' => $resulte['nm_rekan'],
	            'kd_skpd' => $resulte['kd_skpd'],
	            'nm_skpd' => $resulte['nm_skpd'],
	            'nilai1' => number_format($resulte['nilai'],2,'.',','),                                                    
	            'nilai' => $resulte['nilai']              
	            );
	        $ii++;
	    }   
        $result["rows"]   = $row; 
        
        return $result;		
        
	}

	
	public function ambil_total($no_advise) {
		$sql="select total from transaksi.trhadvise where no_advise='$no_advise'";

        $query1 = $this->db->query($sql);

        $result = array();
        $ii     = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'idx' => $ii,
				        'total_pot'    => $resulte['total']
                        );
                        $ii++;
        }
        return $result;
	}

	public function ambil_sp2d_advis($param)
	{
		$result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;
		$where = '';
		$limit = "ORDER BY a.no_sp2d ASC LIMIT $rows OFFSET $offset";
		//if($key!=''){
		//	$where = "where (upper(a.nip) like upper('%$key%') or upper(a.nama) like upper('%$key%'))";	
		//	$limit = "";	
		//}

		$nomor 	= $param['nomor'];
		$sql = "SELECT count(*) as tot FROM transaksi.trhsp2d a WHERE a.no_sp2d NOT IN(SELECT c.no_sp2d FROM transaksi.trdadvise c WHERE a.no_sp2d = c.no_sp2d) $where";
        $query1 = $this->db->query($sql);
        $total = $query1->row();

		$sql = "SELECT a.* FROM transaksi.trhsp2d a WHERE a.no_sp2d NOT IN(SELECT c.no_sp2d FROM transaksi.trdadvise c WHERE a.no_sp2d = c.no_sp2d) $where $limit";
	    $query1 = $this->db->query($sql);       
	    $ii = 0;
	    foreach($query1->result_array() as $resulte)
	    {
	        $row[] = array(
	            'id' => $ii,        
	            'no_sp2d' => $resulte['no_sp2d'],
	            'tgl_sp2d' => $resulte['tgl_sp2d'],
	            'nospm' => $resulte['no_spm'],
	            'nmrekan' => $resulte['nmrekan'],
	            'kd_skpd' => $resulte['kd_skpd'],
	            'nm_skpd' => $resulte['nm_skpd'],
	            'nilai1' => number_format($resulte['nilai'],2,'.',','),                                                     
	            'nilai' => $resulte['nilai']    
	            );
	        $ii++;
	    }
	    if ($ii==0){
        $coba[] = array(
            'id'         => '',        
            'no_sp2d'   => '',
            'tgl_sp2d'  => '',
            'nospm'    => '',
            'nmrekan'  => '',
            'kd_skpd'   => '',
            'nm_skpd'   => '',
            'nilai1'    => '0',
            'nilai'     => ''
            );  
    } 
    	$result["total"] = $total->tot;   
        $result["rows"]   = $row; 
        
        return $result;		
        
	}



}

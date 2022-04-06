<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transfer extends CI_Model {

	public function loadHeader($key) {
		$result = array();
	    $row = array();
	    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows;        
	    
	    if($key !=''){
			$cari  = "(upper(no_kirim) like upper('%$key%'))";	
			$limit = "";	
			$where = " where $cari $limit ";
			}else{
			$limit  = "ORDER BY no_kirim ASC LIMIT $rows OFFSET $offset";
			$where = "";
		}
	    
	    $sql = "SELECT count(*) as total from transaksi.trhkirim $where " ;
	    $query1 = $this->db->query($sql);
	    $total = $query1->row();
	    $result["total"] = $total->total; 
	    $query1->free_result();
	    
	    $sql = "SELECT * from transaksi.trhkirim $where $limit";
	    $query1 = $this->db->query($sql);       
	    $ii = 0;
	    foreach($query1->result_array() as $resulte)
	    { 
	     
	        $row[] = array(
	            'id' => $ii,        
	            'no_kirim' => $resulte['no_kirim'],
	            'tgl_kirim' => $resulte['tgl_kirim'],
	            'bulan' => $resulte['bulan'],
	            'total1' => number_format($resulte['total']),                                                      
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
		$no_kirim 		= $post['no_kirim'];
		$tanggal 		= $post['tanggal'];
		$bulan 			= $post['bulan'];
		$total 			= $post['total'];
		try {
			if($status!='detail'){

				$ck = $this->db->query("SELECT no_kirim FROM transaksi.trhkirim
                           WHERE no_kirim = '$no_kirim'");

				if($ck->num_rows() == 0) {
					$query = "INSERT INTO transaksi.trhkirim(no_kirim,tgl_kirim,total,bulan)
					VALUES('$no_kirim','$tanggal','$total','$bulan')";
			 		$sql = $this->db->query($query);			 		
						return 1;
				} else {
						return 0;
				}

			}else{
				$del = $this->db->where('no_kirim',$post['no_kirim'])
							->delete('transaksi.trhkirim');				

				if($del){
					$query = "INSERT INTO transaksi.trhkirim(no_kirim,tgl_kirim,total,bulan)
					VALUES('$no_kirim','$tanggal','$total','$bulan')";
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

	function simpan_detail($no_kirim,$status,$post){
		$dbsimakda=$this->load->database('simakda', TRUE);		
		try {
			if($status!='detail'){
					foreach($post as $row) {							
						$filter_data = array(
							"no_kirim" => htmlspecialchars($no_kirim, ENT_QUOTES),
							"no_sp2d"   => htmlspecialchars($row->no_sp2d, ENT_QUOTES),
							"nospm"   	=> htmlspecialchars($row->nospm, ENT_QUOTES),
							"tgl_sp2d"  => htmlspecialchars($row->tgl_sp2d, ENT_QUOTES),
							"kd_skpd"  	=> htmlspecialchars($row->kd_skpd, ENT_QUOTES),
							"nm_skpd"  	=> htmlspecialchars($row->nm_skpd, ENT_QUOTES),
							"nilai"    	=> str_replace(array(',',''), array('',''),  $row->nilai)
						);
						$query = "INSERT INTO transaksi.trdkirim(no_kirim,no_sp2d,no_spm,tgl_sp2d,kd_skpd,nm_skpd,nilai)
						VALUES('$no_kirim','$row->no_sp2d','$row->nospm','$row->tgl_sp2d','$row->kd_skpd','$row->nm_skpd','$row->nilai')";
				 		$sql = $this->db->query($query);

				 		//1. transfer trhsp2d ke simakda
				 		$query = "select * from transaksi.trhsp2d where no_sp2d ='$row->no_sp2d'";
				        $query1 = $this->db->query($query);  
				        
				        foreach($query1->result_array() as $sp2d){
							$no_sp2d 	= $sp2d['no_sp2d']; 
							$tgl_sp2d 	= $sp2d['tgl_sp2d']; 
							$no_spm 	= $sp2d['no_spm']; 
							$tgl_spm 	= $sp2d['tgl_spm']; 
							$no_spp 	= $sp2d['no_spp']; 
							$kd_skpd 	= $sp2d['kd_skpd']; 
							$nm_skpd 	= $sp2d['nm_skpd']; 
							$tgl_spp 	= $sp2d['tgl_spp']; 
							$bulan 		= $sp2d['bulan']; 
							$no_spd 	= $sp2d['no_spd']; 
							$keperluan 	= $sp2d['keperluan']; 
							$username 	= $sp2d['username']; 
							$last_update= $sp2d['last_update']; 
							$jns_spp 	= $sp2d['jns_spp']; 
							$bank 		= $sp2d['bank']; 
							$nmrekan 	= $sp2d['nmrekan']; 
							$no_rek 	= $sp2d['no_rek']; 
							$npwp 		= $sp2d['npwp']; 
							$nilai 		= $sp2d['nilai']; 
							$kd_gaji	= $sp2d['kd_gaji']; 							
							 
							  $dbsimakda->query("insert into trhsp2d(no_sp2d,tgl_sp2d,no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,last_update,jns_spp,
							  					bank,nmrekan,no_rek,npwp,nilai,kd_gaji) 
							  	values('$no_sp2d','$tgl_sp2d','$no_spm','$tgl_spm','$no_spp','$kd_skpd','$nm_skpd','$tgl_spp','$bulan','$no_spd','$keperluan','$username','$last_update', 
												'$jns_spp','$bank','$nmrekan','$no_rek','$npwp','$nilai','$kd_gaji') ");
						}
						//akhir transfer trhsp2d ke simakda

						//2. transfer trhspm ke simakda
				 		$query = "select * from transaksi.trhspm where no_spm ='$row->nospm'";
				        $query1 = $this->db->query($query);  
				        
				        foreach($query1->result_array() as $spm){
							$no_spm 	= $spm['no_spm']; 
							$tgl_spm 	= $spm['tgl_spm']; 
							$no_spp 	= $spm['no_spp']; 
							$kd_skpd 	= $spm['kd_skpd']; 
							$nm_skpd 	= $spm['nm_skpd']; 
							$tgl_spp 	= $spm['tgl_spp']; 
							$bulan 		= $spm['bulan']; 
							$no_spd 	= $spm['no_spd']; 
							$keperluan 	= $spm['keperluan']; 
							$username 	= $spm['username']; 
							$last_update= $spm['last_update']; 
							$status		= $spm['status']; 
							$jns_spp 	= $spm['jns_spp']; 
							$bank 		= $spm['bank']; 
							$nmrekan 	= $spm['nmrekan']; 
							$no_rek 	= $spm['no_rek']; 
							$npwp 		= $spm['npwp']; 
							$nilai 		= $spm['nilai'];  							
							 
							  $dbsimakda->query("insert into trhspm(no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,last_update,status,jns_spp,
							  					bank,nmrekan,no_rek,npwp,nilai,status_verifikasi,username_verifikasi,lastupdate_verifikasi) 
							  	values('$no_spm','$tgl_spm','$no_spp','$kd_skpd','$nm_skpd','$tgl_spp','$bulan','$no_spd','$keperluan','$username','$last_update','$status', 
												'$jns_spp','$bank','$nmrekan','$no_rek','$npwp','$nilai','1','$username','$last_update') ");
						}
						//akhir transfer trhspm ke simakda

						//3. transfer trspmpot ke simakda
				 		$query = "select * from transaksi.trspmpot where no_spm ='$row->nospm'";
				        $query1 = $this->db->query($query);  
				        
				        foreach($query1->result_array() as $spmpot){
							$no_spm 	= $spmpot['no_spm']; 
							$kd_rek5 	= $spmpot['kd_rek5']; 
							$nm_rek5 	= $spmpot['nm_rek5']; 
							$nilai 		= $spmpot['nilai']; 
							$kd_skpd 	= $spmpot['kd_skpd'];							 							
							 
							  $dbsimakda->query("insert into trspmpot(no_spm,kd_rek5,nm_rek5,nilai,kd_skpd,pot) 
							  	values('$no_spm','$kd_rek5','$nm_rek5','$nilai','$kd_skpd',0) ");
						}
						//akhir transfer trspmpot ke simakda

						//4. transfer trhspp ke simakda
				 		$query = "select * from transaksi.trhspp where no_spm ='$row->nospm'";
				        $query1 = $this->db->query($query);  
				        
				        foreach($query1->result_array() as $spp){
							$no_spm 	= $spp['no_spm']; 
							$no_spp 	= $spp['no_spp']; 
							$kd_skpd 	= $spp['kd_skpd']; 
							$nm_skpd 	= $spp['nm_skpd']; 
							$tgl_spp 	= $spp['tgl_spp']; 
							$bulan 		= $spp['bulan']; 
							$no_spd 	= $spp['no_spd']; 
							$keperluan 	= $spp['keperluan']; 
							$username 	= $spp['username']; 
							$last_update= $spp['last_update']; 
							$jns_spp 	= $spp['jns_spp']; 
							$bank 		= $spp['bank']; 
							$nmrekan 	= $spp['nmrekan']; 
							$no_rek 	= $spp['no_rek']; 
							$npwp 		= $spp['npwp']; 
							$nilai 		= $spp['nilai'];
							$kd_kegiatan = $spp['kd_kegiatan']; 
							$nm_kegiatan = $spp['nm_kegiatan']; 
							$kd_program = $spp['kd_program']; 
							$nm_program = $spp['nm_program']; 
							$sumber 	= $spp['sumber'];  		

									//5. transfer trdspp ke simakda
							 		$query = "select * from transaksi.trdspp where no_spp ='$no_spp'";
							        $query1 = $this->db->query($query); 

							        foreach($query1->result_array() as $dspp){
							        	$no_spp 	= $dspp['no_spp'];
							        	$kd_rek5 	= $dspp['kd_rek5'];
							        	$nm_rek5 	= $dspp['nm_rek5'];
							        	$nilai 		= $dspp['nilai'];
							        	$kd_skpd 	= $dspp['kd_skpd'];
							        	$kd_kegiatan= $dspp['kd_kegiatan'];
							        	$nm_kegiatan= $dspp['nm_kegiatan'];
							        	$sisa 		= $dspp['sisa'];
							        	$kd 		= $dspp['kd'];
							        	$no_spd 	= $dspp['no_spd']; 

							        	$dbsimakda->query("insert into trdspp(no_spp,kd_rek5,nm_rek5,nilai,kd_skpd,kd_kegiatan,nm_kegiatan,sisa,kd,no_spd) 
							  			values('$no_spp','$kd_rek5','$nm_rek5','$nilai','$kd_skpd','$kd_kegiatan','$nm_kegiatan','$sisa','$kd','$no_spd') ");
							        }//akhir transfer trdspp ke simakda				
										 
							  	$dbsimakda->query("insert into trhspp(no_spp,no_spm,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,last_update,status,jns_spp,jns_beban,
							  					bank,nmrekan,no_rek,npwp,nilai,kd_kegiatan,nm_kegiatan,kd_program,nm_program,sumber) 
							  	values('$no_spp','$no_spm','$kd_skpd','$nm_skpd','$tgl_spp','$bulan','$no_spd','$keperluan','$username','$last_update','1','$jns_spp','LS Gaji',
												'$bank','$nmrekan','$no_rek','$npwp','$nilai','$kd_kegiatan','$nm_kegiatan','$kd_program','$nm_program','$sumber') ");
						}
						//akhir transfer trhspp ke simakda
					}
			}else{
				$del = $this->db->where('no_kirim',$no_kirim)
							->delete('transaksi.trdkirim');
				if($del){
					foreach($post as $row) {							
						$filter_data = array(
							"no_kirim" => htmlspecialchars($no_kirim, ENT_QUOTES),
							"no_sp2d"   => htmlspecialchars($row->no_sp2d, ENT_QUOTES),
							"nospm"   	=> htmlspecialchars($row->nospm, ENT_QUOTES),							
							"tgl_sp2d"  => htmlspecialchars($row->tgl_sp2d, ENT_QUOTES),
							"kd_skpd"  	=> htmlspecialchars($row->kd_skpd, ENT_QUOTES),
							"nm_skpd"  	=> htmlspecialchars($row->nm_skpd, ENT_QUOTES),
							"nilai"    => str_replace(array(',',''), array('',''),  $row->nilai)
						);
						$query = "INSERT INTO transaksi.trdkirim(no_kirim,no_sp2d,no_spm,tgl_sp2d,kd_skpd,nm_skpd,nilai)
						VALUES('$no_kirim','$row->no_sp2d','$row->nospm','$row->tgl_sp2d','$row->kd_skpd','$row->nm_skpd','$row->nilai')";
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
		$no_kirim  = htmlspecialchars($post['no_kirim'], ENT_QUOTES);
		$ex	    	= explode("#", $no_kirim);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->where('no_kirim', $val)
								->delete('transaksi.trhkirim');
					$sql = $this->db->where('no_kirim', $val)
								->delete('transaksi.trdkirim');
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
		$sql = "SELECT count(*) as tot from transaksi.trdkirim where no_kirim = '$nomor' $where";
        $query1 = $this->db->query($sql);
        $total = $query1->row();
        $result["total"] = $total->tot; 

		$sql = "SELECT * from transaksi.trdkirim where no_kirim = '$nomor' $where $limit";
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
	            'nilai1' => number_format($resulte['nilai']),                                                     
	            'nilai' => $resulte['nilai']              
	            );
	        $ii++;
	    }   
        $result["rows"]   = $row; 
        
        return $result;		
        
	}

	
	public function ambil_total($no_kirim) {
		$sql="select total from transaksi.trhkirim where no_kirim='$no_kirim'";

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
		$bulan 	= $param['bulan'];
		$sql = "SELECT count(*) as tot FROM transaksi.trhsp2d a WHERE a.no_sp2d NOT IN(SELECT c.no_sp2d FROM transaksi.trdkirim c WHERE a.no_sp2d = c.no_sp2d) and EXTRACT(MONTH FROM a.tgl_sp2d)='$bulan' $where";
        $query1 = $this->db->query($sql);
        $total = $query1->row();

		$sql = "SELECT a.* FROM transaksi.trhsp2d a WHERE a.no_sp2d NOT IN(SELECT c.no_sp2d FROM transaksi.trdkirim c WHERE a.no_sp2d = c.no_sp2d) and EXTRACT(MONTH FROM a.tgl_sp2d)='$bulan' $where $limit";
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
	            'nilai1' => number_format($resulte['nilai']),                                                     
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

	public function bulan($lccq){
		$sql	= "SELECT n_bulan,nama_bulan FROM public.bulan order by n_bulan ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_SPM_gaji13 extends CI_Model {

	public function loadHeader($key) {
			$result = array();
			$row    = array();
			$page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
			$rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
			$offset = ($page-1)*$rows;

			if($key !=''){
			$cari  = "(upper(a.no_spm) like upper('%$key%'))";	
			$limit = "";	
			$where = " where $cari $limit ";
			}else{
			$limit  = "ORDER BY a.no_spm ASC LIMIT $rows OFFSET $offset";
			$where = "";
			}	
		
		$sql = "SELECT count(*) as tot from transaksi.trhsp2d a $where" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "select a.kd_skpd,a.nm_skpd,a.no_spm,a.no_spp,a.no_spd,a.no_rek,a.npwp,a.tgl_spm,a.keperluan,a.bayar_kepada,a.nilai from transaksi.trhsp2d a $where $limit";
        $query1 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
				'id'          => $ii,        
				'no_spm'      => $resulte['no_spm'],
				'tgl_spm'     => $this->tanggal_ind($resulte['tgl_spm']),
				'keperluan'   => $resulte['keperluan'],
				'no_spp'   	  => $resulte['no_spp'],
				'no_spd'   	  => $resulte['no_spd'],
				'no_rek'   	  => $resulte['no_rek'],
				'npwp'   	  => $resulte['npwp'],
				'kd_skpd'     => $resulte['kd_skpd'],
				'nm_skpd'     => $resulte['nm_skpd'],
				'bayar_kepada' => $resulte['bayar_kepada'],
				'nilai'       => $resulte['nilai'],
				'nilai1'	  => number_format($resulte['nilai'],2,'.',',')
            );
            $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row; 
        return $result;
	}

	public function get_satker($lccq){
		$sql	= "SELECT satkerja,nm_satkerja FROM public.satkerja where satkerja not in('001','002','003') order by satkerja ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function golongan1($lccq){
		$sql	= "SELECT id,nm_golongan FROM public.mgolongan order by id ";
		$query  = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function tanggal_ind($tgl){
		$tahun   =  substr($tgl,0,4);
		$bulan   = substr($tgl,5,2);
		$tanggal =  substr($tgl,8,2);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
		}

	public function untuk($satkerja,$gol1,$gol2) { 
		
        $sql = "SELECT count(*) as tot from public.pegawai_13 Where satkerja = '$satkerja' And kdbantu != 6";
        $query1 = $this->db->query($sql);
        $total = $query1->row();
        $result["total"] = $total->tot; 

        $sql1 = "SELECT count(*) as tot from public.pegawai_13 Where satkerja = '$satkerja' And kdbantu != 6 and stskawin = 1 And kdbantu != 4";
        $query2 = $this->db->query($sql1);
        $total2 = $query2->row();
        $result["total2"] = $total2->tot;

		$sql2 = "SELECT Sum(anak) as tot from public.pegawai_13 Where satkerja = '$satkerja' And kdbantu != 6 and kdbantu != 4";
        $query3 = $this->db->query($sql2);
        $total3 = $query3->row();
        $result["total3"] = $total3->tot;

        return $result;
	}

	public function rekening($satkerja,$gol1,$gol2) { 

        $sql="SELECT '510101010002' as kd_rek5,'Belanja Gaji Pokok PPPK' as nm_rek5, Sum(gapok) as tot, '210108010001' as kd_rek5_pot,'Utang Iuran Wajib Pegawai' as nm_rek5_pot, sum(iwp) as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101020002' as kd_rek5,'Belanja Tunjangan Keluarga PPPK' as nm_rek5, Sum(tistri+tanak) as tot, '210101010002' as kd_rek5_pot,'Potongan THT' as nm_rek5_pot, sum(tht) as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101030002' as kd_rek5,'Belanja Tunjangan Jabatan PPPK' as nm_rek5, Sum(tstruk) as tot, '210105010001' as kd_rek5_pot,'Utang Pph 21 ' as nm_rek5_pot, sum(pph) as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101060002' as kd_rek5,'Belanja Tunjangan Beras PPPK' as nm_rek5, Sum(beras) as tot, '210601010018' as kd_rek5_pot,'Utang Belanja Iuran Jaminan Kesehatan ASN- Iuran Jaminan Kesehatan PPPK' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101070002' as kd_rek5,'Belanja Tunjangan PPh/Tunjangan Khusus PPPK' as nm_rek5, Sum(khusus) as tot, '210107010001' as kd_rek5_pot,'Utang Taperum' as nm_rek5_pot, sum(tabungan) as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101080002' as kd_rek5,'Belanja Pembulatan Gaji PPPK' as nm_rek5, Sum(bulat) as tot, '210304030001' as kd_rek5_pot,'Utang Tunjangan Lain - Lain' as nm_rek5_pot, sum(lain+sewa+hutang) as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all			
			SELECT '510101040002' as kd_rek5,'Belanja Tunjangan Fungsional PPPK' as nm_rek5, Sum(tfung) as tot, '' as kd_rek5_pot,'' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6 and left(kd_fung,1) != 'U'
			union all
			SELECT '510101050002' as kd_rek5,' Belanja Tunjangan Fungsional Umum PPPK' as nm_rek5, Sum(umum) as tot, '' as kd_rek5_pot,'' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6 
			union all
			SELECT '510101100002' as kd_rek5,'Belanja Iuran Jaminan Kecelakaan Kerja PPPK' as nm_rek5, Sum(jkk) as tot, '210601010020' as kd_rek5_pot,'Utang Belanja Jaminan Kecelakaan Kerja ASN- Iuran Jaminan Kecelakaan Kerja PPPK' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101110002' as kd_rek5,'Belanja Iuran Jaminan Kematian PPPK' as nm_rek5, Sum(jkm) as tot, '210601010022' as kd_rek5_pot,'Utang Belanja Iuran Jaminan Kematian ASN- Iuran Jaminan Kematian PPPK' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			union all
			SELECT '510101090002' as kd_rek5,'Belanja Iuran Jaminan Kesehatan PPPK' as nm_rek5, Sum(askes) as tot, '' as kd_rek5_pot,'' as nm_rek5_pot, 0 as tot_pot from public.pegawai_13 Where satkerja = '$satkerja'  And kdbantu != 6
			";

        $query1 = $this->db->query($sql);

        $result = array();
        $ii     = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'idx' => $ii,     
                        'kdrek5'     => $resulte['kd_rek5'],  
                        'nmrek5'     => $resulte['nm_rek5'],  
                        'nilai1'     => number_format($resulte['tot'],2,'.',','),
				        'nilaix'     => $resulte['tot'],
				        'kdrek5_pot' => $resulte['kd_rek5_pot'],  
                        'nmrek5_pot' => $resulte['nm_rek5_pot'],  
                        'nilai1_pot' => number_format($resulte['tot_pot'],2,'.',','),
				        'nilaix_pot' => $resulte['tot_pot']
                        );
                        $ii++;
        }
        return $result;
	}

	function saveData($post,$status){
		$no_spm 		= $post['no_spm'];
		$nomor_sp2d 	= $post['nomor_sp2d'];
		$nomor_spm 		= $post['nomor_spm'];
		$kd_skpd 		= $post['kd_skpd'];
		$nm_satkerja 	= $post['nm_satkerja'];
		$kd_giat 		= $post['kd_giat'];
		$nm_giat 		= $post['nm_giat'];
		$kd_program 	= $post['kd_program'];
		$nm_program 	= $post['nm_program'];
		$no_spd 		= $post['no_spd'];
		$no_rekening 	= $post['no_rekening'];
		$npwp 			= $post['npwp'];
		$bayar_kepada 	= $post['bayar_kepada'];
		$tanggal 		= $post['tanggal'];
		$no_spp 		= $post['no_spp'];
		$bank 			= $post['bank'];
		$untuk 			= $post['untuk'];
		$total 			= $post['total'];
		$total_pot 		= $post['total_pot'];
		$user 			= $post['user'];
		$tglupdate 		= $post['tglupdate'];
		$bln 			= $post['bln'];

		try {
			if($status!='detail'){

				$ck = $this->db->query("SELECT no_spm FROM transaksi.trhsp2d
                           WHERE no_spm = '$nomor_spm' and kd_skpd='$kd_skpd' ");
                $ck = $this->db->query("SELECT no_spm FROM transaksi.trhspm
                           WHERE no_spm = '$nomor_spm' and kd_skpd='$kd_skpd' ");
                $ck = $this->db->query("SELECT no_spm FROM transaksi.trhspp
                           WHERE no_spm = '$nomor_spm' and kd_skpd='$kd_skpd' ");

				if($ck->num_rows() == 0) {
					$query = "INSERT INTO transaksi.trhsp2d(no_sp2d,tgl_sp2d,no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,last_update,jns_spp,
							no_rek,npwp,nilai,kd_gaji,bayar_kepada)
					VALUES('$nomor_sp2d','$tanggal','$nomor_spm','$tanggal','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','$tglupdate','4',
							'$no_rekening','$npwp','$total','3','$bayar_kepada')";
			 		$sql = $this->db->query($query);

			 		$query = "INSERT INTO transaksi.trhspm(no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,status,last_update,jns_spp,
							no_rek,npwp,nilai)
					VALUES('$nomor_spm','$tanggal','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','1','$tglupdate','4',
							'$no_rekening','$npwp','$total')";
			 		$sql = $this->db->query($query);

			 		$query = "INSERT INTO transaksi.trhspp(no_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,status,last_update,jns_spp,
							jns_beban,no_rek,npwp,nilai,kd_kegiatan,nm_kegiatan,sumber,kd_program,nm_program)
					VALUES('$nomor_spm','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','1','$tglupdate','4',
							'LS Gaji','$no_rekening','$npwp','$total','$kd_giat','$nm_giat','DAU','$kd_program','$nm_program')";
			 		$sql = $this->db->query($query);
						return 1;
				} else {
						return 0;
				}

			}else{
				$del = $this->db->where('no_spm',$post['no_spm'])
							->where('kd_skpd',$post['kd_skpd'])
							->delete('transaksi.trhsp2d');
				$del = $this->db->where('no_spm',$post['no_spm'])
							->where('kd_skpd',$post['kd_skpd'])
							->delete('transaksi.trhspm');	
				$del = $this->db->where('no_spm',$post['no_spm'])
							->where('kd_skpd',$post['kd_skpd'])
							->delete('transaksi.trhspp');					

				if($del){
					$query = "INSERT INTO transaksi.trhsp2d(no_sp2d,tgl_sp2d,no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,last_update,jns_spp,
							no_rek,npwp,nilai,kd_gaji,bayar_kepada)
					VALUES('$nomor_sp2d','$tanggal','$nomor_spm','$tanggal','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','tglupdate','4',
							'$no_rekening','$npwp','$total','3','$bayar_kepada')";
			 		$sql = $this->db->query($query);

			 		$query = "INSERT INTO transaksi.trhspm(no_spm,tgl_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,status,last_update,jns_spp,
							no_rek,npwp,nilai)
					VALUES('$nomor_spm','$tanggal','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','1','$tglupdate','4',
							'$no_rekening','$npwp','$total')";
			 		$sql = $this->db->query($query);

			 		$query = "INSERT INTO transaksi.trhspp(no_spm,no_spp,kd_skpd,nm_skpd,tgl_spp,bulan,no_spd,keperluan,username,status,last_update,jns_spp,
							jns_beban,no_rek,npwp,nilai,kd_kegiatan,nm_kegiatan,sumber,kd_program,nm_program)
					VALUES('$nomor_spm','$no_spp','$kd_skpd','$nm_satkerja','$tanggal','$bln','$no_spd','$untuk','$user','1','$tglupdate','4',
							'LS Gaji','$no_rekening','$npwp','$total','$kd_giat','$nm_giat','DAU','$kd_program','$nm_program')";
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

	function simpan_detail($nomor_spm,$status,$post,$post2,$kd_skpd,$no_spp,$kd_giat,$nm_giat,$no_spd){
		
		try {
			if($status!='detail'){	
					foreach($post2 as $row) {							
							$filter_data = array(
								"nomor_spm"  	=> htmlspecialchars($nomor_spm, ENT_QUOTES),
								"kd_rek5_pot"   => htmlspecialchars($row->kd_rek5_pot, ENT_QUOTES),
								"nm_rek5_pot"   => htmlspecialchars($row->nm_rek5_pot, ENT_QUOTES),
								"nilai_pot1"    => str_replace(array(',',''), array('',''), $row->nilai_pot1),
								"kd_skpd"    	=> htmlspecialchars($kd_skpd, ENT_QUOTES)
							);
							if($row->kd_rek5_pot==''){
							}else{
							$query = "INSERT INTO transaksi.trspmpot(no_spm,kd_rek5,nm_rek5,nilai,kd_skpd,pot)
							VALUES('$nomor_spm','$row->kd_rek5_pot','$row->nm_rek5_pot','$row->nilai_pot1','$kd_skpd',0)";
					 		$sql = $this->db->query($query);
							}
							
						}
					foreach($post as $row) {							
							$filter_data = array(
								"no_spp"  	=> htmlspecialchars($no_spp, ENT_QUOTES),
								"kd_rek5"   => htmlspecialchars($row->kd_rek5, ENT_QUOTES),
								"nm_rek5"   => htmlspecialchars($row->nm_rek5, ENT_QUOTES),
								"nilai1"    => str_replace(array(',',''), array('',''), $row->nilai1),
								"kd_skpd"   => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"kd_giat"  	=> htmlspecialchars($kd_giat, ENT_QUOTES),
								"nm_giat"  	=> htmlspecialchars($nm_giat, ENT_QUOTES),
								"no_spd"  	=> htmlspecialchars($no_spd, ENT_QUOTES)
							);
							$query = "INSERT INTO transaksi.trdspp(no_spp,kd_rek5,nm_rek5,nilai,kd_skpd,kd_kegiatan,nm_kegiatan,sisa,kd,no_spd)
							VALUES('$no_spp','$row->kd_rek5','$row->nm_rek5','$row->nilai1','$kd_skpd','$kd_giat','$nm_giat',0,0,'$no_spd')";
					 		$sql = $this->db->query($query);
						}
						

			}else{
				$del = $this->db->where('nomor_spm',$nomor_spm)
							->where('kd_skpd',$kd_skpd)
							->delete('transaksi.trspmpot');
				if($del){
						foreach($post2 as $row) {							
							$filter_data = array(
								"nomor_spm"  	=> htmlspecialchars($nomor_spm, ENT_QUOTES),
								"kd_rek5_pot"   => htmlspecialchars($row->kd_rek5_pot, ENT_QUOTES),
								"nm_rek5_pot"   => htmlspecialchars($row->nm_rek5_pot, ENT_QUOTES),
								"nilai_pot1"    => str_replace(array(',',''), array('',''), $row->nilai_pot1),
								"kd_skpd"    	=> htmlspecialchars($kd_skpd, ENT_QUOTES)
							);
							if($row->kd_rek5_pot==''){
							}else{
							$query = "INSERT INTO transaksi.trspmpot(no_spm,kd_rek5,nm_rek5,nilai,kd_skpd,pot)
							VALUES('$nomor_spm','$row->kd_rek5_pot','$row->nm_rek5_pot','$row->nilai_pot1','$kd_skpd',0)";
					 		$sql = $this->db->query($query);
					 		}
						}
						foreach($post as $row) {							
							$filter_data = array(
								"no_spp"  	=> htmlspecialchars($no_spp, ENT_QUOTES),
								"kd_rek5"   => htmlspecialchars($row->kd_rek5, ENT_QUOTES),
								"nm_rek5"   => htmlspecialchars($row->nm_rek5, ENT_QUOTES),
								"nilai1"    => str_replace(array(',',''), array('',''), $row->nilai1),
								"kd_skpd"   => htmlspecialchars($kd_skpd, ENT_QUOTES),
								"kd_giat"  	=> htmlspecialchars($kd_giat, ENT_QUOTES),
								"nm_giat"  	=> htmlspecialchars($nm_giat, ENT_QUOTES),
								"no_spd"  	=> htmlspecialchars($no_spd, ENT_QUOTES)
							);
							$query = "INSERT INTO transaksi.trdspp(no_spp,kd_rek5,nm_rek5,nilai,kd_skpd,kd_kegiatan,nm_kegiatan,sisa,kd,no_spd)
							VALUES('$no_spp','$row->kd_rek5','$row->nm_rek5','$row->nilai1','$kd_skpd','$kd_giat','$nm_giat',0,0,'$no_spd')";
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
		$no_spm = htmlspecialchars($post['no_spm'], ENT_QUOTES);
		$no_spp = htmlspecialchars($post['no_spp'], ENT_QUOTES);
		$ex	    = explode("#", $no_spm);
		$ex1	= explode("#", $no_spp);
		try{
			if(count($ex) > 0){
				foreach($ex as $idx=>$val){
					$sql = $this->db->where('no_spm', $val)
								->delete('transaksi.trhsp2d');
					$sql = $this->db->where('no_spm', $val)
								->delete('transaksi.trhspm');
					$sql = $this->db->where('no_spm', $val)
								->delete('transaksi.trspmpot');
					$sql = $this->db->where('no_spm', $val)
								->delete('transaksi.trhspp');
				}	
				foreach($ex1 as $idx=>$val1){					
					$sql = $this->db->where('no_spp', $val1)
								->delete('transaksi.trdspp');
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
		$nomor 	= $param['nomor'];
		$skpd 	= $param['skpd'];

		$result   = array();
        $row      = array();
        $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows     = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset   = ($page-1)*$rows;
        $limit = "ORDER BY a.no_spm ASC LIMIT $rows OFFSET $offset";

        $sql = "SELECT count(*) as tot from transaksi.trhsp2d a 
				inner join transaksi.trdspp b on a.no_spp=b.no_spp
				where a.no_spm='$nomor' and a.kd_skpd='$skpd'" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "select a.kd_skpd,a.no_spm,b.kd_rek5,b.nm_rek5,b.nilai,'' as kd_rek5_pot,'' as nm_rek5_pot,0 as nilai_pot 
				from transaksi.trhsp2d a 
				inner join transaksi.trdspp b on a.no_spp=b.no_spp
				where a.no_spm='$nomor' and a.kd_skpd='$skpd' $limit";
        $query2 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query2->result_array() as $resulte)
        {        	
				$row[] = array( 
	            	'id'          => $ii,               
					'no_spm'      => $resulte['no_spm'],
					'kd_rek5'     => $resulte['kd_rek5'],
					'nm_rek5'     => $resulte['nm_rek5'],
					'nilai'       => number_format($resulte['nilai'],2,'.',','),
					'nilai1'      => $resulte['nilai']		
            	);
            	$ii++;
            
	    }   

        $query2->free_result();        
        $result["total"] = $total->tot;
        $result["rows"]   = $row; 
        
        return $result;		
        
	}

	public function load_detail_pot($param)
	{
		$nomor 	= $param['nomor'];
		$skpd 	= $param['skpd'];

		$result   = array();
        $row      = array();
        $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows     = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset   = ($page-1)*$rows;
        $limit 	  = "ORDER BY a.no_spm ASC LIMIT $rows OFFSET $offset";

        $sql = "SELECT count(*) as tot from transaksi.trhsp2d a 
				inner join transaksi.trhspm b on a.no_spm=b.no_spm
				inner join transaksi.trspmpot e on b.no_spm=e.no_spm
				where a.no_spm='$nomor' and a.kd_skpd='$skpd'" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row();
		
        $sql = "select a.kd_skpd,a.no_spm,'' as kd_rek5,'' as nm_rek5,0 as nilai,e.kd_rek5 as kd_rek5_pot,e.nm_rek5 as nm_rek5_pot,e.nilai as nilai_pot 
				from transaksi.trhsp2d a 
				inner join transaksi.trhspm b on a.no_spm=b.no_spm
				inner join transaksi.trspmpot e on b.no_spm=e.no_spm
				where a.no_spm='$nomor' and a.kd_skpd='$skpd' $limit";
        $query2 = $this->db->query($sql);  
        $result = array();
        $ii = 0;
        foreach($query2->result_array() as $resulte)
        {
				$row[] = array( 
	            	'id'          => $ii,               
					'no_spm'      => $resulte['no_spm'],
					'kd_rek5_pot' => $resulte['kd_rek5_pot'],
					'nm_rek5_pot' => $resulte['nm_rek5_pot'],
					'nilai_pot'   => number_format($resulte['nilai_pot'],2,'.',','),
					'nilai_pot1'  => $resulte['nilai_pot']		
            	);
            	$ii++;
        		       
            
	    }   

        $query2->free_result();        
        $result["total"] = $total->tot;
        $result["rows"]   = $row; 
        
        return $result;		
        
	}

	public function ambil_total($kd_skpd,$no_spm) { 

        $csql = "select sum(b.nilai) as total_rek from transaksi.trhsp2d a inner join transaksi.trdspp b on a.no_spp=b.no_spp
				where  a.no_spm='$no_spm' and a.kd_skpd='$kd_skpd'";
				
        $query1 = $this->db->query($csql);
        $ntotal = $query1->row('total_rek');

		 $sql="select sum(c.nilai) as total_pot from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm 
				inner join transaksi.trspmpot c on b.no_spm=c.no_spm
				where  a.no_spm='$no_spm' and a.kd_skpd='$kd_skpd'";

        $query1 = $this->db->query($sql);

        $result = array();
        $ii     = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'idx' => $ii,
				        'total_potx'    => $resulte['total_pot'],
				        'total_rekx' 	=> $ntotal
                        );
                        $ii++;
        }
        return $result;
	}



}

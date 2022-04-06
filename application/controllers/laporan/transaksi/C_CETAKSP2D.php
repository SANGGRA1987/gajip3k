<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CETAKSP2D extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('transaksi/M_CETAKSP2D');
	}

	function _mpdf($judul='',$isi='',$lMargin=2,$rMargin=2,$font=2,$orientasi) {
        
          	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
       // $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
         $mpdf->pdf->AddPage('P','','','','',2,2,2,2);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'SURAT PERINTAH PENCAIRAN DANA',
			'judul'		=> 'CETAK SP2D',
			'deskripsi'	=> 'SURAT PERINTAH PENCAIRAN DANA'
		);

		$this->template->views('transaksi/dokumen/V_CETAKSP2D', $data);
	}
	
	public function  tanggal_balik($tgl){
		/*$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;*/
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$xtgl 	= substr($tgl, 6, 2);
		$xbulan 	= substr($tgl, 9, 2);
		$xtahun  = substr($tgl, 0, 4);
	 
		$result = $xtgl . " " . $BulanIndo[(int)$xbulan-1] . " ". $xtahun;		
		return($result);

	}
	
	function  tanggal_format_indonesia($tgl){
            
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this->getBulanIndo($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

    }
	
	

	function  getBulanIndo($bln){
        switch  ($bln){
        case  01:
        return  "Januari";
        break;
        case  02:
        return  "Februari";
        break;
        case  03:
        return  "Maret";
        break;
        case  04:
        return  "April";
        break;
        case  05:
        return  "Mei";
        break;
        case  06:
        return  "Juni";
        break;
        case  07:
        return  "Juli";
        break;
        case  08:
        return  "Agustus";
        break;
        case  09:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
		}
    }

	public function getConfig()
	{
		return $this->M_CETAKSP2D->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_CETAKSP2D->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_CETAKSP2D->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_CETAKSP2D->getSkpd(); 
	}

	public function getPangkat()
	{
		echo $this->M_CETAKSP2D->getPangkat(); 
	}

		public function getsp2d()
	{
		echo $this->M_CETAKSP2D->getsp2d(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_CETAKSP2D->getUnitSkpd($param);
	}


	public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		
		if ($nilai < 12) {
			return " " . $huruf[$nilai];
		} else if ($nilai <20) {
			return $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			return $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			return  " seratus". $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			return $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			return " seribu". $this-> penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			return $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			return $this-> penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		
		}     
		
	}

	public function cetaksp2d()
	{
		$config = $this->getConfig();
		$kota	= strtoupper($config['nm_daerah']);
		$jenisCetak = $this->input->get('jenisCetak');
		//$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		$tgl_sp2d = $this->tanggal_balik($this->input->get('tgl_sp2d'));
		$nosp2d = $this->input->get('no_sp2d');
		$printer = $this->input->get('printer');
		$tahun = $this->input->get('tahun_tglcetak');
	
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah'])
		);


		$bluePrint = $this->M_CETAKSP2D->cetaksp2d($data);
		$where = "where a.no_sp2d='$nosp2d'";

		$sqlc="select * from public.config;";
		 $con = $this->db->query($sqlc);
        	$conf = $con->row();
			        			$nm_kaban  =$conf->ankep;
			        			$nip_kaban  =$conf->nipankep;
			        			$jab_kaban  =$conf->jbankep;


		$sql="select a.no_sp2d,a.tgl_sp2d,a.no_spm,a.tgl_spm,c.no_spp,a.kd_skpd,d.nm_satkerja,c.keperluan ,(select sum(nilai) from transaksi.trdspp where no_spp=c.no_spp) as nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp  inner join public.satkerja d on left(a.kd_skpd,7)=d.satkerja  $where ;";

		  $hasil = $this->db->query($sql);
        	$trh = $hasil->row();
								
			        			$kd_skpd  =$trh->kd_skpd;
			        			$nm_satkerja  =$trh->nm_satkerja;
			        			$no_spm =$trh->no_spm;
			        			$tgl_spm =$trh->tgl_spm;
			        			$no_sp2d =$trh->no_sp2d;
			        			$keperluan=$trh->keperluan;
			        			$nilai_sp2d =$trh->nilai;
			        			$nilai =$trh->nilai;
			        			$terbilang_sp2d= $this->penyebut($nilai);


		$i=0;
		$j=0;
		$k=0;

          	

 			$cRet = '';
    		$cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">";
   			 $cRet .="
   					 	<tr>
   						 	<td align=\"center\" width=\"50%\"><b>PEMERINTAH DAERAH ASMAT</b>
   						 	</td>
   						 	
   						 	<td align=\"center\" width=\"50%\" height=\"40\">
		    					 <table style=\"border-collapse:collapse;\" width=\"400\" align=\"center\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
	
				    					 <tr>
				    					 	<td align=\"center\"><b>SURAT PERINTAH PENCAIRAN DANA<br>(SP2D)</b></td>
				    					</tr>
		    					
		    					</table>
    						</td>
    					</tr>   
   						
   						<tr>
    						<td>
   								 <table style=\"border-collapse:collapse;\" width=\"420\" align=\"left\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
    								<tr>
			    						<td width=\"20%\" align=\"left\">&nbsp;Nomor SPM</td>
			   							<td width=\"1\">:&nbsp;</td>
			    						<td width=\"60%\">$no_spm</td>
    								</tr>

    								<tr>
									    <td width=\"20%\"  align=\"left\">&nbsp;Tanggal</td>
									    <td width=\"1\">:&nbsp;</td>
									    <td width=\"60%\">$tgl_spm</td>
   									 </tr>

								    <tr>
									    <td valign =\"top\" width=\"25%\" align=\"left\">&nbsp;SKPD</td>
									    <td valign =\"top\" width=\"1\">:&nbsp;</td>
									    <td  width=\"60%\">$nm_satkerja</td>
								    </tr>
    							</table>
    						</td>
   							
   							<td>
   								<table style=\"border-collapse:collapse;\" width=\"400\" align=\"center\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
    								<tr>
									    <td width=\"50%\">&nbsp;Nomor SP2D</td>
									    <td width=\"50%\">:&nbsp;$no_sp2d</td>

								    </tr>
   									
   									<tr>
									    <td>&nbsp;Dari</td>
									    <td>:&nbsp;KUASA BUD</td>
								    </tr>
    								<tr>
								    	<td>&nbsp;Tahun Anggaran</td>
									    <td>:&nbsp;2018";
							   $cRet .="</td>
                 					</tr>
                 				</table>
							</td>
						</tr>   

						<tr>
							<td colspan=\"2\"  height=\"60\"> &nbsp;Bank/Pos : BANK PAPUA<br>&nbsp;Hendaklah mencairkan / memindahbukukan dari bank Rekening Nomor ..............<br>&nbsp;Uang sebesar Rp  ".number_format($nilai_sp2d,'2',',','.')."  <br><i>&nbsp;Terbilang :$terbilang_sp2d</i><br>
							</td>
						</tr>    
						<tr>
                 			<td colspan=\"2\">
               				  <table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"0\" cellspacing=\"4\" cellpadding=\"-1\">
					                 <tr>
						                 <td width=\"20%\" height=\"20\">&nbsp;Kepada</td>
						                 <td>:&nbsp;Harap Membayar Kepada Para Pegawai $nm_satkerja se-Kabupaten Asmat yang mempunyai rekening pada Bank PAPUA Cabang</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;NPWP</td>
						                 <td>:&nbsp;</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;No.Rekening Bank</td>
						                 <td>:&nbsp;</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;Bank/Pos</td>
						                 <td>:&nbsp;BANK PAPUA CABANG AGATS</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\" valign=\"top\">&nbsp;Keperluan Untuk</td>
						                 <td>:&nbsp;$keperluan</td>
					                 </tr>
                			  </table>   
               			    </td>
               		  </tr>
              		  <tr>
                			 <td colspan=\"2\">
               				    <table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"1\" cellspacing=\"4\" cellpadding=\"2\">
		                			 <tr>
						                 <td width=\"45\" align=\"center\"><b>NO</b></td>
						                 <td width=\"118\" align=\"center\"><b>KODE REKENING</b></td>
						                 <td width=\"370\" align=\"center\"><b>URAIAN</b></td>
						                 <td width=\"150\" align=\"center\" height=\"20\"><b>JUMLAH(Rp)</b></td>
					                 </tr>";

					                 $k=0;
									$sql2="select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm
									inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trdspp d on c.no_spp=d.no_spp 
									inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja order by d.kd_rek5;";
		 							$hasil = $this->db->query($sql2);
		 							foreach ($hasil->result() as $row)
                									 {
                									 	$k++;
							  $cRet .="<tr>
				                      <td align=\"center\" height=\"20\">&nbsp;$k</td>
				                      <td>&nbsp;$row->kd_kegiatan.$row->kd_rek5&nbsp;</td>
				                      <td>$row->nm_rek5</td>
				                      <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
				                      </tr>";

				                  }

				              $cRet .="<tr>
							            <td align=\"center\" height=\"20\">&nbsp;</td>
							            <td>&nbsp;</td>
							            	<td align=\"right\">&nbsp;<b>Jumlah</b>&nbsp;</td>
							            	<td align=\"right\"><b>".number_format($nilai_sp2d,'2',',','.')."</b>&nbsp;</td>
							            </tr>
							            <tr>
							            	<td colspan=\"4\" height=\"20\">&nbsp;<b>Potongan-Potongan</b></td>
							            </tr>
							    </table>  
							 </td>
						</tr>
						<tr>
							<td colspan=\"2\">
							    <table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
							            <tr>
								            <td width=\"35\" align=\"center\"><b>NO</b></td>
								            <td width=\"376\" align=\"center\"><b>Uraian (No.Rekening)</b></td>
								            <td width=\"227\" align=\"center\"><b>Jumlah (Rp)</b></td>
								            <td width=\"150\" align=\"center\" height=\"20\"><b>Keterangan</b></td>
							            </tr>";
					$totalpot=0;
						$sql3 = "select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trspmpot d on b.no_spm=d.no_spm inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja $where order  by d.kd_rek5;";
          				  $hasil = $this->db->query($sql3);
          
           				 foreach ($hasil->result() as $row)
							            {
							            	$l++;
							            	$totalpot = $totalpot + $row->nilai;
									    $cRet .="<tr>
										             <td align=\"center\" height=\"20\">&nbsp;$l</td>
										             <td>&nbsp;$row->nm_rek5</td>
										             <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
										             <td>&nbsp;</td>
									             </tr>";  				               
        								 }
        								 $cRet .="
										         <tr>
											         <td height=\"20\">&nbsp;</td>
											         <td align=\"right\">Jumlah&nbsp;</td>
											         <td align=\"right\">".number_format($totalpot,'2',',','.')."&nbsp;</td>
											         <td></td>
										         </tr>
										         <tr>
										         <td colspan=\"4\" height=\"20\">&nbsp;Informasi:<i>(tidak mengurangi jumlah pembayaran SP2D)</i></td>
										         </tr>
         						</table>  
        					 </td>
        				 </tr>
        				 <tr>
        					 <td colspan=\"2\">
         							<table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
								         <tr>
									         <td width=\"35\" align=\"center\"><b>NO</b></td>
									         <td width=\"376\" align=\"center\"><b>Uraian</b></td>
									         <td width=\"227\" align=\"center\"><b>Jumlah(Rp)</b></td>
									         <td width=\"150\" align=\"center\" height=\"20\"><b>Keterangan</b></td>
								         </tr>";


						$sql4 = "select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a 
								inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trspmpot d on b.no_spm=d.no_spm 
									inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja $where and d.kd_rek5='2130101' order  by d.kd_rek5;";
							         $hasil = $this->db->query($sql4);
							         $lcno = 0;
							         $totalpott = 0;
							         foreach ($hasil->result() as $row)
							         {
							             $lcno = $lcno + 1;
							             $totalpott = $totalpott + $row->nilai;
							             $cRet .="<tr>
										             <td align=\"center\" height=\"20\">&nbsp;$lcno</td>
										             <td>&nbsp;$row->nm_rek5</td>
										             <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
										             <td>&nbsp;</td>
							           				 </tr>";    
         							   }
         								 $cRet .="
								         <tr>
									         <td height=\"20\">&nbsp;</td>
									         <td align=\"right\"><b>Jumlah</b>&nbsp;</td>
									         <td align=\"right\"><b>".number_format($totalpott,'2',',','.')."</b>&nbsp;</td>
									         <td></td>
								        	 </tr>
									         <tr>
									         <td colspan=\"4\" height=\"20\" valign=\"bottom\">&nbsp;<b>SP2D yang Dibayarkan</b></td>
									         </tr>
								    </table>  
								</td>
							</tr>
							<tr>
        						 <td colspan=\"2\">
         							<table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
								         <tr>
									         <td width=\"305\" align=\"left\" height=\"20\">&nbsp;Jumlah yang Diminta</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($nilai_sp2d,'2',',','.')."</td>
									         <td width=\"120\" align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								         </tr>


								         <tr>
									         <td align=\"left\" height=\"20\">&nbsp;Jumlah Potongan</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($totalpot,'2',',','.')."</td>
									         <td align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								         </tr>
								         <tr>
									         <td align=\"left\" height=\"20\">&nbsp;Jumlah yang Dibayarkan</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($nilai_sp2d-$totalpot,'2',',','.')."</td>
									         <td align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								
								         </tr>";
										$nilai=$nilai_sp2d-$totalpot;
								         $terbilang_total= $this->penyebut($nilai);
								        
									$cRet .="
								          <tr>
								        	 <td colspan=\"4\" align=\"left\" height=\"20\">&nbsp;Uang Sejumlah : 
								         	<i>$terbilang_total rupiah</i></td>
								        	</tr>
								    </table>  
								</td>
						</tr>

 						<tr>
        					 <td colspan=\"2\">
        						 <table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
        							 <tr>
								         <td width=\"60%\" align=\"left\" style=\"font-size:12px\" valign=\"top\">
							
								         <td width=\"40%\" align=\"center\">AGATS,$tgl_sp2d<br>$jab_kaban</br><br></br><br></br><br></br><br></br><br></br><br></br>
								         <b><u>$nm_kaban</u></b><br>
								         <b>NIP.$nip_kaban</b>                
								         </td>
								         </tr>";
								        

					$cRet .="
               	   				</table>
               	   			</td>
               	   		</tr>
               	   		
				</table>";
			
		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Perintah Pencairan Dana' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		
		        	$this->_mpdf('',$cRet,2,2,2,'P');
		        		break;
		        	case 1:
		        		header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-excel");
			            header("Content-Disposition: attachment; filename= $judul.xlsx");
			            $this->load->view('transaksi/excel', $data);
			            break;
	        		case 2:
	        			header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-word");
			            header("Content-Disposition: attachment; filename= $judul.doc");
			           	$this->load->view('transaksi/excel', $data);
	        			break;
		        	default:
		        		echo "Error";
		        		break;
		        }

	}

}

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */

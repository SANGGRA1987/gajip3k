<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_lap_advise extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/lap_advise/M_lap_advise');
	}

	function _mpdf1($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

    function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='') {
        ob_clean();
        ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Hal {PAGENO} of {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'LAPORAN ADVISE',
			'judul'		=> 'LAPORAN ADVISE',
			'deskripsi'	=> 'LAPORAN ADVISE'
		);

		$this->template->views('laporan/lap_advise/V_lap_advise', $data);
	}
	
	public function  tanggal_balik($tgl){
        //2021-12-05
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
     
        $xtgl   = substr($tgl, 5, 2);
        $xbulan = substr($tgl, 9, 2);
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
		return $this->M_lap_advise->getConfig();
	}

	public function getpenghasilan()
	{
		echo $this->M_lap_advise->getpenghasilan(); 
	}

	public function cetakLaporan()
	{
		$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		$no_advise = $this->input->get('no_advise');

        $cRet ='';        
        $sqlsc="SELECT upper(cona) as kab_kota,kota as daerah,thang as thn_ang FROM public.config";
		
        $sqlsclient=$this->db->query($sqlsc);
        foreach ($sqlsclient->result() as $rowsc)
        {
	 		$kab     = $rowsc->kab_kota;
	 		$daerah  = $rowsc->daerah;
	 		$thn     = $rowsc->thn_ang;
        }
        $sql=$this->db->query("select * from transaksi.trhadvise where no_advise='$no_advise'");
        foreach($sql->result() as $row){
	 		$no=$row->no_advise;
	 		$tgl=$row->tgl_advise;
        }

        $sqlttd2="SELECT nama,nip,jabatan FROM ttd where ckey='BUD'";
        $sqlttd2=$this->db->query($sqlttd2);
        foreach ($sqlttd2->result() as $rowttd2)
        {
            $nipbud=$rowttd2->nip;                    
            $namabud= $rowttd2->nama;
            $jabatanbud  = $rowttd2->jabatan;
        }
		
		$sqljum=$this->db->query("select sum(a.nilai) as nilai from transaksi.trdadvise a inner join transaksi.trhadvise b on a.no_advise=b.no_advise where tgl_advise<'$tgl'");
		foreach($sqljum->result() as $row){
 		$tot_lalu=$row->nilai;
		$tot_hari_lalu    =number_format($tot_lalu,2,",",".");
        }
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
			
            <tr>
                <td colspan=\"5\" align=\"center\" style=\"font-size:14;border-bottom:none;\"><stong><b>PEMERINTAH KABUPATEN $kab</b></strong></td>
            </tr>
            <tr>
                <td colspan=\"5\" align=\"center\" style=\"font-size:14;border-top:none;border-bottom:none;\"><stong><b>DAFTAR PENGUJI<b></strong></td>
            </tr>
            <tr>
                <td colspan=\"5\" align=\"center\" style=\"font-size:12;border-top:none;border-bottom:none;\"><b>SURAT PERINTAH PENCAIRAN DANA (SP2D)<b></td>
            </tr>
			<tr>
                <td colspan=\"5\" align=\"center\" style=\"font-size:12;border-top:none;border-bottom:none;\"><b>TANGGAL : $tgl_cetak<b></td>
            </tr>
            <tr>
                <td colspan=\"5\" align=\"center\" >&nbsp;</td>
            </tr></table>";
        $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
        <thead>
        <tr>
            <td colspan=\"5\" align=\"left\" style=\"font-size:10;border-top:none;border-left:none;border-right:none;\"><b>Nomor Advise : $no_advise</b></td>
        </tr>
			
            <tr>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"5%\" align=\"center\"><b>NO URUT</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"20%\" align=\"center\"><b>TANGGAL DAN NOMOR SP2D</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"30%\" align=\"center\"><b>NAMA SKPD</b></td>
				<td style=\" font-size:10;border:solid 1px black;\" width=\"20%\" align=\"center\"><b>NAMA YANG BERHAK</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"15%\" align=\"center\"><b>JUMLAH</b><br>(Rp)</td>
            </tr>
			<tr>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"5%\" align=\"center\"><b>1</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"20%\" align=\"center\"><b>2</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"30%\" align=\"center\"><b>3</b></td>
				<td style=\" font-size:10;border:solid 1px black;\" width=\"20%\" align=\"center\"><b>4</b></td>
                <td style=\" font-size:10;border:solid 1px black;\" width=\"15%\" align=\"center\"><b>5</b></td>
            </tr>
			</thead>
            <tr>
                <td style=\" font-size:10;border-left:solid 1px black;border-right:solid 1px black;\" width=\"5%\"  align=\"center\"><b></b></td>
                <td style=\" font-size:10;border-left:solid 1px black;border-right:solid 1px black;\" width=\"20%\" align=\"center\"><b></b></td>
                <td style=\" font-size:10;border-left:solid 1px black;border-right:solid 1px black;\" width=\"30%\" align=\"center\"><b></b></td>
                <td style=\" font-size:10;border-left:solid 1px black;border-right:solid 1px black;\" width=\"20%\" align=\"left\"><b></b></td>
                <td style=\" font-size:10;border-left:solid 1px black;border-right:solid 1px black;\" width=\"15%\" align=\"right\"><b></b></td>
            </tr>
            <tfoot>
                <tr>
                    <td colspan=\"5\" style=\"border-bottom:solid 1px black;\"></td>
                </tr>
            </tfoot>
        ";
        
 		$i=0;
 		$sqld=$this->db->query("SELECT a.no_sp2d,a.tgl_sp2d AS tgl_sp2d,a.kd_skpd,a.nm_skpd,a.nilai,a.pot,a.nm_rekan FROM transaksi.trdadvise a where a.no_advise='$no_advise' order by tgl_sp2d,left(a.no_sp2d,4)");
 		
		
		$kotor=0;$potong=0;$bersih=0;
 		$lcno = 0;
            foreach($sqld->result() as $row1){
     		$lcno = $lcno + 1;
     		$nosp2d=$row1->no_sp2d;
     		$tgl_sp2d=$row1->tgl_sp2d;
     		$kd_skpd=$row1->nm_skpd;
     		$nmrekan=empty($row1->nm_rekan) || $row1->nm_rekan == null ?'' :$row1->nm_rekan;
     		$nilai  =number_format($row1->nilai,2,",",".");
     		$pot    =number_format($row1->pot,2,",",".");
     		$net=$row1->nilai - $row1->pot;
     		$i++;
 		$cRet .=" <tr>
                            <td valign=\"top\" style=\"font-size:10;border-left:solid 1px black;border-right:solid 1px black; border-bottom:solid 1px black;\" width=\"5%\" align=\"center\">$i)</td>
                            <td valign=\"top\" style=\"font-size:10;border-left:solid 1px black;border-right:solid 1px black; border-bottom:solid 1px black;\" width=\"20%\" align=\"wrap\">". $this->tanggal_balik($tgl_sp2d)." & $nosp2d</td>
                            <td valign=\"top\" style=\"font-size:10;border-left:solid 1px black;border-right:solid 1px black; border-bottom:solid 1px black;\" width=\"30%\" align=\"left\">$kd_skpd</td>
                            <td valign=\"top\" style=\"font-size:10;border-left:solid 1px black;border-right:solid 1px black; border-bottom:solid 1px black;\" width=\"20%\" align=\"left\">$nmrekan</td>
                            <td valign=\"top\" style=\"font-size:10;border-left:solid 1px black;border-right:solid 1px black; border-bottom:solid 1px black;\" width=\"15%\" align=\"right\">$nilai</td>
                    </tr>
					";
     		$kotor=$kotor + $row1->nilai;
     		$potong=$potong+ $row1->pot;
     		$bersih =$bersih + $net;
            }
			$kotorasli=$kotor;
			$jumsampeini=number_format($tot_lalu+$kotorasli,2,",",".");

        $cRet .="
				<tr>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-left:solid 1px black;\" witdh=\"5%\" align=\"center\"></td>
                    <td colspan=\"2\" style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" witdh=\"40%\" align=\"left\"><b>Jumlah Hari Ini :</b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" width=\"10%\" align=\"right\"><b></b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-right:solid 1px black;\" width=\"10%\" align=\"right\"><b>".number_format($kotor,2,',','.')."</b></td>
                </tr>
				<tr>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-left:solid 1px black;\" witdh=\"5%\" align=\"center\"></td>
                    <td colspan=\"2\" style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" witdh=\"40%\" align=\"left\"><b>Jumlah Hari Lalu :</b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" width=\"10%\" align=\"right\"><b></b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-right:solid 1px black;\" width=\"10%\" align=\"right\"><b>$tot_hari_lalu</b></td>
                </tr>
				<tr>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-left:solid 1px black;\" witdh=\"5%\" align=\"center\"></td>
                    <td colspan=\"2\" style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" witdh=\"40%\" align=\"left\"><b>Jumlah s/d Hari Ini :</b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;\" width=\"10%\" align=\"right\"><b></b></td>
                    <td style=\"font-size:10;border-top:solid 1px black;border-bottom:solid 1px black;border-right:solid 1px black;\" width=\"10%\" align=\"right\"><b>$jumsampeini</b></td>
                </tr>
        </table>";
        $cRet .="<table style=\"border-collapse:collapse;font-size:10\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">";
        $cRet .="<tr>
                    <td colspan=\"5\" style=\" border-right:none;border-bottom:none;border-left:none;\" width=\"10%\" align=\"left\">Terbilang  : <i>".$this->terbilang($kotor)." rupiah</i></td>
                </tr></table>";        
				$cRet .="<table style=\"border-collapse:collapse;font-size:10;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
        		
		for($i=1;$i<=1;$i++){
 		$cRet .="
				
				<tr>
                            <td style=\"font-size:11;\" width=\"5%\" align=\"center\">&nbsp;</td>
                            <td style=\"font-size:11;\" width=\"20%\" align=\"center\">&nbsp;</td>
                            <td style=\"font-size:11;\" width=\"30%\" align=\"justify\">&nbsp;</td>
                            <td style=\"font-size:11;\" width=\"20%\" align=\"justify\">&nbsp;</td>
                            <td style=\"font-size:11;\" width=\"15%\" align=\"right\">&nbsp;</td></tr>";
        }
        $cRet .="<tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\"  style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\"  style=\"font-size:11;\" width=\"50%\" align=\"center\">$daerah, $tgl_cetak</td>
                </tr>
                <tr>
                    <td colspan=\"3\"  style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\"  style=\"font-size:11;\" width=\"50%\" align=\"center\"><b>$jabatanbud</b></td>
                </tr>
               
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\"><b><u>$namabud</u></b></td>
                </tr>
                <tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\"><b>NIP . $nipbud</b></td>
                </tr>
				<tr>
                    <td colspan=\"3\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>
                    <td colspan=\"1\" style=\"font-size:11;\" width=\"50%\" align=\"center\">&nbsp;</td>                    
                </tr>";      
		$cRet .="</table>";
		$data['prev']= $cRet;
      	//echo $cRet;
        //$this->_mpdf('',$cRet, 8, 5, 2, '0');
          $this->_mpdf('',$cRet,10,10,10,'P');

	}

	function terbilang ($x) {
	   $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	   if ($x < 12)
	     return " " . $abil[$x] ;
	   elseif ($x < 20)
	     return $this->terbilang($x - 10) . " Belas";
	   elseif ($x < 100)
	     return $this->terbilang($x / 10) . " Puluh" . $this->terbilang(fmod($x,10));
	   elseif ($x < 200)
	     return " Seratus" . $this->terbilang($x - 100);
	   elseif ($x < 1000)
	     return $this->terbilang($x / 100) . " Ratus" . $this->terbilang(fmod($x,100));
	   elseif ($x < 2000)
	     return " Seribu" . $this->terbilang($x - 1000);
	   elseif ($x < 1000000)
	     return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang(fmod($x,1000));
	   elseif ($x < 1000000000)
	     return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang(fmod($x,1000000));
	   elseif ($x < 1000000000000)
	     return $this->terbilang($x / 1000000000) . " Milyar" . $this->terbilang(fmod($x,1000000000));
	   elseif ($x < 1000000000000000)
	     return $this->terbilang($x / 1000000000000) . " Trilyun" . $this->terbilang(fmod($x,1000000000000));
	}



}

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */

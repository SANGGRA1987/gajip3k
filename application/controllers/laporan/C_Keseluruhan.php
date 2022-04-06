<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Keseluruhan extends CI_Controller {

    public function __construct()
    
    {
        parent::__construct();
        $this->load->library('pdf');
    }

        public function bulan($bln)
    {
        //$bln = date("m");
        switch ($bln) {
            case 1: 
            return "Januari";
                break;
            case 2: 
            return "Februari";
                break;
            case 3:
            return "Maret";
                break;
            case 4: 
            return "April";
                break;
            case 5: 
            return "Mei";
                break;
            case 6: 
            return "Juni";
                break;
            case 7: 
            return "Juli";
                break;
            case 8: 
            return "Agustus";
                break;
            case 9: 
            return "September";
                break;
            case 10: 
            return "Oktober";
                break;
            case 11: 
            return "November";
                break;
            case 12: 
            return "Desember";
                break;
                                                                  
        }

    }

    public function keseluruhan(){

	    	if (isset($_POST['kd_skpd1'])) {

                $no = 0;
                $skpd1 = $_POST['kd_skpd1'];
                $skpd1 = '1.20.07';
                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $pdf = new FPDF('L','mm','LEGAL');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(19,19); // Setting Margin
                $pdf->SetFont('Arial','B',12);// Setting Jenis Font Yang Akan Digunakan HEADER
                $pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(10,7,'DAFTAR REKAPITULASI KESELURUHAN',0,0,'L');
                $pdf->Cell(260,5,'Lapiran III : S.E MENTERI DALAM NEGERI',0,1,'R');
                $pdf->Cell(10,9,'IWP, PPH, TAPERUM, SEWA RUMAH, TUNJANGAN BERAS',0,0,'L');
                $pdf->Cell(228,7,'376/65a/PUOD',0,1,'R');
                $pdf->Cell(10,9,'PEGAWAI NEGERI SIPIL DAERAH',0,0,'L');
                $pdf->Cell(221,7,'21/02/1995',0,1,'R');
                $pdf->Cell(10,9,'KABUPATEN ASMAT',0,0,'L');
                $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel
        
                $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(10,10,'No ',1,0,'C');
                $pdf->Cell(135,10,'Unit Kerja',1,0,'C');
                $pdf->Cell(25,10,'IWP',1,0,'C');
                $pdf->Cell(20,10,'PPH',1,0,'C');
                $pdf->Cell(20,10,'Taperum',1,0,'C');
                $pdf->Cell(25,10,'Sewa Rumah',1,0,'C');
                $pdf->Cell(30,10,'Tunjangan Beras',1,0,'C');
                $pdf->Cell(25,10,'Akses',1,0,'C');
                $pdf->Cell(25,10,'Jumlah',1,1,'C');
                $pdf->SetFont('Arial','',10); // font dan ukuran font

                $sql = "SELECT a.satkerja,a.nm_satkerja,
                        (select count(*) as jml_peg from pegawai b where b.satkerja=a.satkerja) as jml_peg,
                        (select sum(iwp) as Iuran_Wajib_Pokok from pegawai c where c.satkerja=a.satkerja) as iwp,
                        (select sum(pph) as PPH from pegawai d where d.satkerja=a.satkerja) as pph,
                        (select sum(tabungan) as PPH from pegawai d where d.satkerja=a.satkerja) as tabungan,
                        (select sum(sewa) as sewa_rumah from pegawai e where e.satkerja=a.satkerja) as sewa,
                        (select sum(beras) as PPH from pegawai d where d.satkerja=a.satkerja) as tberas, 
                        (select sum(askes) as PPH from pegawai d where d.satkerja=a.satkerja) as askes 
                        from satkerja a where a.satkerja = '$skpd1' ";
                $nm_satkerja = $this->db->query($sql)->result();
                $niwp=0;
                $npph=0;
                $ntabungan=0;
                $nsewa=0;
                $nberas=0;
                $naskes=0;
                $njumlah=0;
               
                foreach ($nm_satkerja as $row){
                        $no++;
                        $iwp = $row->iwp;
                        $iwp1 = number_format($iwp ,0,',','.');
                        $pph = $row->pph;
                        $pph1 = number_format($pph ,0,',','.');
                        $tabungan = $row->tabungan;
                        $tabungan1 = number_format($tabungan ,0,',','.');
                        $sewa = $row->sewa;
                        $sewa1 = number_format($sewa ,0,',','.');
                        $beras = $row->tberas;
                        $beras1 = number_format($beras ,0,',','.');
                        $askes = $row->askes;
                        $askes1 = number_format($askes ,0,',','.');
                        $jumlah = ($iwp+$pph+$tabungan+$sewa+$beras+$askes);
                        $jumlah1 = number_format($jumlah, 0,',','.');

                        $niwp = $niwp + $iwp;
                        $jiwp = number_format($niwp, 0,',','.');
                        $npph = $npph + $pph;
                        $jpph = number_format($npph, 0,',','.');
                        $ntabungan = $ntabungan + $tabungan;
                        $jtabungan = number_format($ntabungan, 0,',','.');
                        $nsewa = $nsewa + $sewa;
                        $jsewa = number_format($nsewa, 0,',','.');
                        $nberas = $nberas + $beras;
                        $jberas = number_format($nberas, 0,',','.');
                        $naskes = $naskes + $askes;
                        $jaskes = number_format($naskes, 0,',','.');
                        $njumlah = $njumlah + $jumlah;
                        $jjumlah = number_format($njumlah, 0,',','.');

                        $pdf->Cell(10,6,"$no",1,0); 
                        $pdf->Cell(135,6,"$row->nm_satkerja",1,0);
                        $pdf->cell(25,6,"$iwp1",1,0);  
                        $pdf->cell(20,6,"$pph1",1,0);
                        $pdf->cell(20,6,"$tabungan1",1,0);
                        $pdf->Cell(25,6,"$sewa1",1,0);
                        $pdf->Cell(30,6,"$beras1",1,0);
                        $pdf->Cell(25,6,"$askes1",1,0);
                        $pdf->Cell(25,6,"$jumlah1",1,1);
                }
                //$sql_jumlah = ""
                $pdf->Cell(10,6,"",1,0);
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(135,6,"JUMLAH KESELURUHAN. . . . . . . . . ",1,0);
                $pdf->Cell(25,6,"$jiwp",1,0);
                $pdf->Cell(20,6,"$jpph",1,0);
                $pdf->Cell(20,6,"$jtabungan",1,0);
                $pdf->Cell(25,6,"$jsewa",1,0);
                $pdf->Cell(30,6,"$jberas",1,0);
                $pdf->Cell(25,6,"$jaskes",1,0);
                $pdf->Cell(25,6,"$jjumlah",1,0);
                $pdf->Cell(0,10,'',0,1);
                $pdf->SetFont('Arial','',13);
                $pdf->Cell(220,5,"AGATS, $tanggal $c_bulan $tahun",0,1,'R');
                $pdf->Cell(213,9,'Kepala BPKAD',0,1,'R');
                $pdf->Cell(225,9,'Bendahara Umum Daerah',0,1,'R');
                $pdf->Cell(0,20,'',0,1);
                $pdf->SetFont('Arial','U',13);
                $pdf->Cell(235,9,'HALASON F SINURAT, SSTP,M.Si',0,1,'R');
                $pdf->SetFont('Arial','',13);
                $pdf->Cell(210,2,'PEMBINA',0,1,'R');
                $pdf->Cell(227,11,'NIP.198108241999121001',0,1,'R');
                $pdf->Cell(10,9,'',0,0,'L');
                $pdf->Output();
            }

        else{
           $no = 0;
               // $skpd1 = $_POST['kd_skpd1'];
                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $pdf = new FPDF('L','mm','LEGAL');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(19,19); // Setting Margin
                $pdf->SetFont('Arial','B',12);// Setting Jenis Font Yang Akan Digunakan HEADER
                $pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(10,7,'DAFTAR REKAPITULASI KESELURUHAN',0,0,'L');
                $pdf->Cell(260,5,'Lapiran III : S.E MENTERI DALAM NEGERI',0,1,'R');
                $pdf->Cell(10,9,'IWP, PPH, TAPERUM, SEWA RUMAH, TUNJANGAN BERAS',0,0,'L');
                $pdf->Cell(228,7,'376/65a/PUOD',0,1,'R');
                $pdf->Cell(10,9,'PEGAWAI NEGERI SIPIL DAERAH',0,0,'L');
                $pdf->Cell(221,7,'21/02/1995',0,1,'R');
                $pdf->Cell(10,9,'KABUPATEN ASMAT',0,0,'L');
                $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel
        
                $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(10,10,'No ',1,0,'C');
                $pdf->Cell(135,10,'Unit Kerja',1,0,'C');
                $pdf->Cell(25,10,'IWP',1,0,'C');
                $pdf->Cell(20,10,'PPH',1,0,'C');
                $pdf->Cell(20,10,'Taperum',1,0,'C');
                $pdf->Cell(25,10,'Sewa Rumah',1,0,'C');
                $pdf->Cell(30,10,'Tunjangan Beras',1,0,'C');
                $pdf->Cell(25,10,'Akses',1,0,'C');
                $pdf->Cell(25,10,'Jumlah',1,1,'C');
                $pdf->SetFont('Arial','',10); // font dan ukuran font

                $sql = "SELECT a.satkerja,a.nm_satkerja,
                        (select count(*) as jml_peg from pegawai b where b.satkerja=a.satkerja) as jml_peg,
                        (select sum(iwp) as Iuran_Wajib_Pokok from pegawai c where c.satkerja=a.satkerja) as iwp,
                        (select sum(pph) as PPH from pegawai d where d.satkerja=a.satkerja) as pph,
                        (select sum(tabungan) as PPH from pegawai d where d.satkerja=a.satkerja) as tabungan,
                        (select sum(sewa) as sewa_rumah from pegawai e where e.satkerja=a.satkerja) as sewa,
                        (select sum(beras) as PPH from pegawai d where d.satkerja=a.satkerja) as tberas, 
                        (select sum(askes) as PPH from pegawai d where d.satkerja=a.satkerja) as askes 
                        from satkerja a where a.satkerja not in('001','003','002') ";
                $nm_satkerja = $this->db->query($sql)->result();
                $niwp=0;
                $npph=0;
                $ntabungan=0;
                $nsewa=0;
                $nberas=0;
                $naskes=0;
                $njumlah=0;
                foreach ($nm_satkerja as $row){
                        $no++;
                        $iwp = $row->iwp;
                        $iwp1 = number_format($iwp ,0,',','.');
                        $pph = $row->pph;
                        $pph1 = number_format($pph ,0,',','.');
                        $tabungan = $row->tabungan;
                        $tabungan1 = number_format($tabungan ,0,',','.');
                        $sewa = $row->sewa;
                        $sewa1 = number_format($sewa ,0,',','.');
                        $beras = $row->tberas;
                        $beras1 = number_format($beras ,0,',','.');
                        $askes = $row->askes;
                        $askes1 = number_format($askes ,0,',','.');
                        $jumlah = ($iwp+$pph+$tabungan+$sewa+$beras+$askes);
                        $jumlah1 = number_format($jumlah, 0,',','.');

                        $niwp = $niwp + $iwp;
                        $jiwp = number_format($niwp, 0,',','.');
                        $npph = $npph + $pph;
                        $jpph = number_format($npph, 0,',','.');
                        $ntabungan = $ntabungan + $tabungan;
                        $jtabungan = number_format($ntabungan, 0,',','.');
                        $nsewa = $nsewa + $sewa;
                        $jsewa = number_format($nsewa, 0,',','.');
                        $nberas = $nberas + $beras;
                        $jberas = number_format($nberas, 0,',','.');
                        $naskes = $naskes + $askes;
                        $jaskes = number_format($naskes, 0,',','.');
                        $njumlah = $njumlah + $jumlah;
                        $jjumlah = number_format($njumlah, 0,',','.');

                        $pdf->Cell(10,6,"$no",1,0); 
                        $pdf->Cell(135,6,"$row->nm_satkerja",1,0);
                        $pdf->cell(25,6,"$iwp1",1,0);  
                        $pdf->cell(20,6,"$pph1",1,0);
                        $pdf->cell(20,6,"$tabungan1",1,0);
                        $pdf->Cell(25,6,"$sewa1",1,0);
                        $pdf->Cell(30,6,"$beras1",1,0);
                        $pdf->Cell(25,6,"$askes1",1,0);
                        $pdf->Cell(25,6,"$jumlah1",1,1);
                }
                //$sql_jumlah = ""
                $pdf->Cell(10,6,"",1,0);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(135,6,"JUMLAH KESELURUHAN. . . . . . . . . ",1,0);
                $pdf->Cell(25,6,"$jiwp",1,0);
                $pdf->Cell(20,6,"$jpph",1,0);
                $pdf->Cell(20,6,"$jtabungan",1,0);
                $pdf->Cell(25,6,"$jsewa",1,0);
                $pdf->Cell(30,6,"$jberas",1,0);
                $pdf->Cell(25,6,"$jaskes",1,0);
                $pdf->Cell(25,6,"$jjumlah",1,0);
                $pdf->Cell(0,10,'',0,1);
                $pdf->SetFont('Arial','',13);
                $pdf->Cell(220,5,"AGATS, $tanggal $c_bulan $tahun",0,1,'R');
                $pdf->Cell(213,9,'Kepala BPKAD',0,1,'R');
                $pdf->Cell(225,9,'Bendahara Umum Daerah',0,1,'R');
                $pdf->Cell(0,20,'',0,1);
                $pdf->SetFont('Arial','U',13);
                $pdf->Cell(235,9,'HALASON F SINURAT, SSTP,M.Si',0,1,'R');
                $pdf->SetFont('Arial','',13);
                $pdf->Cell(210,2,'PEMBINA',0,1,'R');
                $pdf->Cell(227,11,'NIP.198108241999121001',0,1,'R');
                $pdf->Cell(10,9,'',0,0,'L');
                $pdf->Output();
        }
                
    }
	
}

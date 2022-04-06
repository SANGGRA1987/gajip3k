<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tunjangan_beras extends CI_Controller {

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


    public function tunjangan_beras(){
    	
       if (isset($_POST['kd_skpd1'])) {

                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $skpd1 = $_POST['kd_skpd1'];
                $harga_beras = 8725;
                //$skpd1 = '1.01.01';
                $no = 0;
                $pdf = new FPDF('L','mm','LEGAL');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(19,19);           
                $pdf->SetFont('Times','B',14);// Setting Jenis Font Yang Akan Digunakan HEADER
                $pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(0,7,'DAFTAR REKAPITULASI DO BERAS CPNS/PNS DAERAH',0,1,'C');
                $pdf->SetFont('Times','',12);
                $pdf->Cell(0,9,'OTONOM SE - KABUPATEN ASMAT',0,1,'C');
                $pdf->Cell(0,9,"Bulan : $c_bulan $tahun",0,1,'C');
                $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel

                $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(10,10,'No ',1,0,'C');
                $pdf->Cell(158,10,'SATUAN KERJA',1,0,'C');
                $pdf->Cell(20,10,'PEGAWAI',1,0,'C');
                $pdf->Cell(25,10,'SUAMI/ISTRI',1,0,'C');
                $pdf->Cell(20,10,'ANAK',1,0,'C');
                $pdf->Cell(27,10,'JUMLAH JIWA',1,0,'C');
                $pdf->Cell(25,10,'BERAS (KG)',1,0,'C');
                $pdf->Cell(40,10,'HARGA BERAS',1,1,'C');
                $pdf->SetFont('Arial','',12); // font dan ukuran font

                $sql = "SELECT a.satkerja, a.nm_satkerja,
                       (select count(*) as jml_peg from pegawai b where b.satkerja=a.satkerja) as jml_peg,
                       (select count(*) as istri from pegawai c where c.satkerja=a.satkerja and stskawin = '1') as istri,
                       (select sum(anak) as jumlah_anak from pegawai d where d.satkerja=a.satkerja) as jumlah_anak
                       from satkerja a where a.satkerja = '$skpd1'" ;
              
                $n_beras = 0;
                $n_total_peg = 0;
                $n_total_istri = 0;
                $n_total_anak = 0;
                $n_total_jiwa = 0;
                $n_total_beras = 0;
                $n_harga_beras = 0;
                $askes = $this->db->query($sql)->result();
                foreach ($askes as $row){
                        $no++;
                        $nm_satkerja = $row->nm_satkerja;
                        $n_jml_peg = $row->jml_peg;
                        $n_istri = $row->istri;
                        $n_jumlah_anak = $row->jumlah_anak;
                        $n_jumlah_jiwa = $n_istri+$n_jumlah_anak;
                        $j_jumlah_jiwa = number_format($n_jumlah_jiwa ,0,',','.');
                        $n_beras = $n_jumlah_jiwa * 10;
                        $j_beras = number_format($n_beras,0,',','.');
                        $n_harga_beras = $n_beras * $harga_beras;
                        $j_harga_beras = number_format($n_harga_beras,0,',','.');

                        $pdf->SetFont('Arial','B',10);
                        $pdf->Cell(10,7,"$no",1,0,'R');  
                        $pdf->Cell(158,7,"$nm_satkerja",1,0,'L');
                        $pdf->Cell(20,7,"$n_jml_peg",1,0,'R');  
                        $pdf->Cell(25,7,"$n_istri",1,0,'R');  
                        $pdf->Cell(20,7,"$n_jumlah_anak",1,0,'R');
                        $pdf->Cell(27,7,"$j_jumlah_jiwa",1,0,'R');  
                        $pdf->Cell(25,7,"$j_beras",1,0,'R');
                        $pdf->Cell(40,7,"$j_harga_beras",1,1,'R');
                    }
                      
                        $pdf->SetFont('Arial','B',11);
                        $pdf->Cell(168,9,"JUMLAH KESELURUHAN . . . . . . . .",1,0,'L');
                        $pdf->Cell(20,9,"$n_jml_peg",1,0,'R');  
                        $pdf->Cell(25,9,"$n_istri",1,0,'R');  
                        $pdf->Cell(20,9,"$n_jumlah_anak",1,0,'R');
                        $pdf->Cell(27,9,"$j_jumlah_jiwa",1,0,'R');  
                        $pdf->Cell(25,9,"$j_beras",1,0,'R');
                        $pdf->Cell(40,9,"$j_harga_beras",1,1,'R');
                        
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
                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $harga_beras = 8725;
                //$skpd1 = $_POST['kd_skpd1'];
                //$skpd1 = '1.01.01';
                $no = 0;
                $nip = '196005021981031020';
                $pdf = new FPDF('L','mm','LEGAL');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(19,19);           
                $pdf->SetFont('Times','B',14);// Setting Jenis Font Yang Akan Digunakan HEADER
                $pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(0,7,'DAFTAR REKAPITULASI DO BERAS CPNS/PNS DAERAH',0,1,'C');
                $pdf->SetFont('Times','',12);
                $pdf->Cell(0,9,'OTONOM SE - KABUPATEN ASMAT',0,1,'C');
                $pdf->Cell(0,9,"Bulan : $c_bulan $tahun",0,1,'C');
                $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel
        
                $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(10,10,'No ',1,0,'C');
                $pdf->Cell(158,10,'SATUAN KERJA',1,0,'C');
                $pdf->Cell(20,10,'PEGAWAI',1,0,'C');
                $pdf->Cell(25,10,'SUAMI/ISTRI',1,0,'C');
                $pdf->Cell(20,10,'ANAK',1,0,'C');
                $pdf->Cell(27,10,'JUMLAH JIWA',1,0,'C');
                $pdf->Cell(25,10,'BERAS (KG)',1,0,'C');
                $pdf->Cell(40,10,'HARGA BERAS',1,1,'C');
                $pdf->SetFont('Arial','',12); // font dan ukuran font
 
                $sql = "SELECT a.satkerja, a.nm_satkerja,
                       (select count(*) as jml_peg from pegawai b where b.satkerja=a.satkerja) as jml_peg,
                       (select count(*) as istri from pegawai c where c.satkerja=a.satkerja and stskawin = '1') as istri,
                       (select sum(anak) as jumlah_anak from pegawai d where d.satkerja=a.satkerja) as jumlah_anak
                       from satkerja a where a.satkerja not in('001','003','002')";
                $n_beras = 0;
                $n_total_peg = 0;
                $n_total_istri = 0;
                $n_total_anak = 0;
                $n_total_jiwa = 0;
                $n_total_beras = 0;
                $n_harga_beras = 0;
                $tunjangan = $this->db->query($sql)->result();
                foreach ($tunjangan as $row){
                        $no++;
                        $nm_satkerja = $row->nm_satkerja;
                        $n_jml_peg = $row->jml_peg;
                        $n_istri = $row->istri;
                        $n_jumlah_anak = $row->jumlah_anak;
                        $n_jumlah_jiwa = $n_istri+$n_jumlah_anak;
                        $j_jumlah_jiwa = number_format($n_jumlah_jiwa ,0,',','.');
                        $n_beras = $n_jumlah_jiwa * 10;
                        $j_beras = number_format($n_beras,0,',','.');
                        $n_harga_beras = $n_beras * $harga_beras;
                        $j_harga_beras = number_format($n_harga_beras,0,',','.');

                        $n_total_peg = $n_total_peg + $n_jml_peg ;
                        $j_total_peg = number_format($n_total_peg,0,',','.');
                        $n_total_istri = $n_total_istri + $n_istri ;
                        $j_total_istri = number_format($n_total_istri,0,',','.');
                        $n_total_anak = $n_total_anak + $n_jumlah_anak ;
                        $j_total_anak = number_format($n_total_anak,0,',','.');
                        $n_total_jiwa = $n_total_jiwa + $n_jumlah_jiwa ;
                        $j_total_jiwa = number_format($n_total_jiwa,0,',','.');
                        $n_total_beras = $n_total_beras + $n_beras;
                        $j_total_beras = number_format($n_total_beras,0,',','.');
                        $n_total_harga_beras = $n_harga_beras + $n_harga_beras;
                        $j_total_harga_beras = number_format($n_total_harga_beras,0,',','.');
                    
                        $pdf->Cell(10,6,"$no",1,0); 
                        $pdf->Cell(158,6,"$nm_satkerja",1,0);  
                        $pdf->Cell(20,6,"$n_jml_peg",1,0,'R'); 
                        $pdf->Cell(25,6,"$n_istri",1,0,'R');  
                        $pdf->Cell(20,6,"$n_jumlah_anak",1,0,'R');
                        $pdf->Cell(27,6,"$j_jumlah_jiwa",1,0,'R');  
                        $pdf->Cell(25,6,"$j_beras",1,0,'R'); 
                        $pdf->Cell(40,6,"$j_harga_beras",1,1,'R'); 
                       
                    }

                        $pdf->SetFont('Arial','B',12);
                        $pdf->Cell(168,10,"JUMLAH KESELURUHAN. . . . . . . . . ",1,0);
                        $pdf->Cell(20,10,"$j_total_peg",1,0,'R');
                        $pdf->Cell(25,10,"$j_total_istri",1,0,'R');  
                        $pdf->Cell(20,10,"$j_total_anak",1,0,'R');
                        $pdf->Cell(27,10,"$j_total_jiwa",1,0,'R');  
                        $pdf->Cell(25,10,"$j_total_beras",1,0,'R'); 
                        $pdf->Cell(40,10,"$j_total_harga_beras",1,1,'R'); 

                       

                        $pdf->Cell(40,7,"",0,1);
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

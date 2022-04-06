<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_do_beras extends CI_Controller {

    public function __construct()
    
    {
        parent::__construct();
      //  $this->load->model('Laporan/M_Iwp');
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

    function terbilang($x){
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
            return " " . $abil[$x];
        elseif ($x < 20)
            return $this->terbilang($x - 10) . " belas";
        elseif ($x < 100)
            return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
        elseif ($x < 200)
            return " seratus" . $this->terbilang($x - 100);
        elseif ($x < 1000)
            return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
        elseif ($x < 2000)
            return " seribu" . $this->terbilang($x - 1000);
        elseif ($x < 1000000)
            return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
        elseif ($x < 1000000000)
            return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
    }

    public function do_beras(){

            $tanggal = date("d");
            $bln = date("m");
            $tahun = 2018;
            $c_bulan = $this->bulan($bln);
            $skpd = $_POST['kd_skpd1'];
            //$skpd = '1.01.01';
            $pdf = new FPDF('L','mm','Legal1');
            $pdf->AddPage(); // Membuat Halaman Baru
            $pdf->SetMargins(12,0);           
            $pdf->SetFont('times','B','U',12);
            $pdf->cell(0,5,'DO BERAS ATAS DASAR SPMU GAJI (DO SPMU BERAS) PROVINSI/KABUPATEN/KOTAMADYA *)',0,2,'C');
            $pdf->SetX(78);
            $pdf->cell(197,1,'','B',1,'C'); //menciptakan garis
            $pdf->Cell(15,5,'',0,1);

            $sql_unit_kerja = "SELECT distinct a.nm_satkerja from public.satkerja a inner join 
                               public.pegawai b ON a.satkerja=b.satkerja
                               where a.satkerja = '$skpd'";
            $unit_kerja = $this->db->query($sql_unit_kerja)->result();
                foreach ($unit_kerja as $row){
                    $nm_satkerja = $row->nm_satkerja;
                }
            $pdf->SetFont('times','',10);
            $pdf->cell(70,5,"Nama Satuan Kerja  : $nm_satkerja",0,1,'L');
            $pdf->cell(70,5,"Gaji bulan                 : $c_bulan $tahun",0,1,'L');
            $pdf->cell(0,1,'','B',1,'C');
            $pdf->cell(0,1,'','B',2,'C');
            $pdf->Cell(0,3,'',0,2);
            $pdf->SetFont('times','',11);
            $pdf->SetX(25);
            $pdf->Cell(0,2,'Tanggal dan nomor Daftar Gaji : Tanggal. . . . . . . . . . . . .Nomor . . . . . . . . . . . . .',0,1,'L');
            $pdf->SetX(25);
            $pdf->Cell(0,7,'Surat Keterangan nomor : . . . . . . . . . . .  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .',0,1,'L');
            $pdf->SetX(25);
            $pdf->cell(155,0,'','B',10,'R');
            $pdf->SetFont('times','',11);
            $pdf->SetX(25);
            $pdf->cell(0,5,'A.',0,0,'L');
            $pdf->SetX(35);
            $pdf->cell(0,5,'Provinsi/Kabupaten/Kotamadya *) :',0,1,'L'); 
            $pdf->SetX(35);    
            $pdf->cell(0,3,'Instansi/Kantor/Satuan Kerja :',0,1,'L');
            $pdf->SetX(35); 
            $pdf->cell(0,7,"$nm_satkerja",0,0,'L');
            $pdf->SetX(35); 
            $pdf->cell(0,15,"Alamat Lengkap :....................................................................................",0,1,'L');
            $pdf->SetY(65);
            $pdf->SetX(25);
            $pdf->cell(0,0,'B.',0,0,'L');
            $pdf->SetX(35);
            $pdf->cell(0,0,'Keterangan jumlah pegawai dan keluarga untuk memperoleh jatah beras.',0,1,'L'); 
            $pdf->SetX(35);
            $pdf->cell(0,10,"BULAN : $c_bulan $tahun",0,1,'L');
            $pdf->SetY(73);
            $pdf->SetX(35);
            $pdf->SetFont('Arial','B',11); // Setting jenis font yg akan digunakan dalam tabel   
            $pdf->Cell(20,10,'Golongan',1,0,'C');
            $pdf->Cell(25,10,'Jml pegawai',1,0,'C');
            $pdf->Cell(20,10,'jml istri',1,0,'C');
            $pdf->Cell(20,10,'jml anak',1,0,'C');
            $pdf->Cell(20,10,'jumlah',1,0,'C');
            $pdf->Cell(25,10,'Keterangan',1,1,'C');

            
            $pdf->SetFont('Arial','',10); // font dan ukuran font
            $sql="SELECT 'I' as nmgol,count(nip) as jmlpeg, sum(anak) as jml_anak, (select count(nip) as jml_istri from public.pegawai where stskawin = '1' and satkerja='$skpd' and left(golongan,1) = '1') from public.pegawai b where b.satkerja='1.01.01' and left(b.golongan,1) = '1' union
select 'II' as nmgol,count(nip) as jmlpeg, sum(anak) as jml_anak, (select count(nip) as jml_istri from public.pegawai where stskawin = '1' and satkerja='$skpd' and left(golongan,1) = '2') from public.pegawai b where b.satkerja='1.01.01' and left(b.golongan,1)= '2' union
select 'III' as nmgol,count(nip) as jmlpeg, sum(anak) as jml_anak, (select count(nip) as jml_istri from public.pegawai where stskawin = '1' and satkerja='$skpd' and left(golongan,1) = '3') from public.pegawai b where b.satkerja='1.01.01' and left(b.golongan,1) = '3' union
select 'IV' as nmgol,count(nip) as jmlpeg, sum(anak) as jml_anak, (select count(nip) as jml_istri from public.pegawai where stskawin = '1' and satkerja='$skpd' and left(golongan,1) = '4') from public.pegawai b where b.satkerja='1.01.01' and left(b.golongan,1)= '4' order by nmgol";
            $n_jumlah_peg = 0;
            $n_jumlah_anak = 0;
            $n_jumlah_jiwa = 0;
            $n_jumlah_istri = 0;
             //$j_jatah_beras=0;
            $golongan = $this->db->query($sql)->result();
            foreach ($golongan as $row){
                    $pdf->SetX(35);
                    //MENGAMBIL RECORD
                    $n_jml_peg = $row->jmlpeg;
                    $n_jml_istri = $row->jml_istri;
                    $n_jml_anak = $row->jml_anak; 
                    $n_jumlah = $n_jml_anak + $n_jml_peg+$n_jml_istri;
                    $j_jumlah = number_format($n_jumlah ,0,',','.');

                    //JUMLAH KESELURUHAN
                    $n_jumlah_peg=$n_jumlah_peg+$n_jml_peg;
                    $j_jml_peg1 = number_format($n_jumlah_peg ,0,',','.');
                    $n_jumlah_istri = $n_jumlah_istri + $n_jml_istri;
                    $j_jml_istri = number_format($n_jumlah_istri ,0,',','.');
                    $n_jumlah_anak=$n_jumlah_anak+$n_jml_anak;
                    $j_jml_anak1 = number_format($n_jumlah_anak ,0,',','.');
                    $n_jumlah_jiwa=$n_jumlah_jiwa+$n_jumlah;
                    $j_jiwa = number_format($n_jumlah_jiwa ,0,',','.');
                    $x=$n_jumlah_jiwa * 10; //jumlah jiwa
                    $j_jatah_beras = number_format($x,0,',','.');

                    $pdf->Cell(20,6,"$row->nmgol",1,0); 
                    $pdf->Cell(25,6,"$n_jml_peg",1,0); 
                    $pdf->Cell(20,6,"$n_jml_istri",1,0);
                    $pdf->Cell(20,6,"$n_jml_anak",1,0);  
                    $pdf->Cell(20,6,"$j_jumlah",1,0);
                    $pdf->Cell(25,6,'',1,1,'C');
            }
            $terbilang = $this->terbilang($x);
            $pdf->SetX(35);
            $pdf->SetFont('Times','B',11);
            $pdf->Cell(20,6,"JUMLAH",1,0); 
            $pdf->Cell(25,6,"$j_jml_peg1",1,0); 
            $pdf->Cell(20,6,"$j_jml_istri",1,0);
            $pdf->Cell(20,6,"$j_jml_anak1",1,0);  
            $pdf->Cell(20,6,"$j_jiwa",1,0);
            $pdf->Cell(25,6,'',1,1,'C');
            $pdf->SetY(112);
            $pdf->SetX(25);
            $pdf->SetFont('Times','',12);
            $pdf->cell(0,8,'C.',0,0,'L');
            $pdf->SetX(35);
            $pdf->Cell(0,8,'Jatah beras menurut jumlah pegawai dan keluarga cq. Jumlah jiwa',0,1,'L');
            $pdf->SetX(55);
            $pdf->Cell(0,0,"$j_jiwa     x   10Kg =  $j_jatah_beras  Kg",0,1);
            $pdf->setX(35);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,8,"(dengan huruf : $terbilang Kg)",0,1,'L');
            $pdf->SetX(25);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,2,"CATATAN :",0,1,'L');
            $pdf->SetX(25);
            $pdf->Multicell(75,5,"DO SPMU beras ini mencakup ..............(............) Satuan Kerja sebagaimana tercantum dalam Daftar.Nominatif Satuan Kerja terlampir",0,'L');
            $pdf->SetY(125);
            $pdf->SetX(120);
            $pdf->Cell(0,10,"AGATS,     $tanggal  $c_bulan  $tahun",0,1,'L');
            $pdf->SetY(130);
            $pdf->SetX(120);
            $pdf->Cell(0,10,"BENDAHARAWAN GAJI",0,1,'L');
            $pdf->SetY(145);
            $pdf->SetX(130);
            $pdf->Cell(0,10,"SAHRIYANTI",0,1,'L');
            $pdf->SetY(150);
            $pdf->SetX(115);
            $pdf->Cell(0,10,"PENGATUR MUDA TINGKAT I",0,1,'L');
            $pdf->SetY(155);
            $pdf->SetX(119);
            $pdf->Cell(0,8,"NIP.    198312222010042001",0,1,'L');
            $pdf->SetY(162);
            $pdf->SetX(25);
            $pdf->cell(155,0,'','B',10,'R');
            $pdf->SetY(33);
            $pdf->SetX(180);
            $pdf->Cell(0.5,197,'',1,0,'L'); //GARIS PEMBAGI
            $pdf->SetY(165);
            $pdf->SetX(25);
            $pdf->cell(0,0,'D.',0,0,'L');
            $pdf->SetY(163);
            $pdf->SetX(35);
            $pdf->Multicell(150,4,"Jumlah pegawai, istri dan anak tersebut di atas telah di periksa dan sesuai dengan yang tercantum dalam daftar gaji induk yang berkenaan untuk mana di terbitkan SPMU tanggal ..............F............Nomor......................",0,'L');
            $pdf->SetY(180);
            $pdf->SetX(140);
            $pdf->Cell(1,1,"Kepala BPKAD",0,0,'C');
            $pdf->SetY(185);
            $pdf->SetX(140);
            $pdf->Cell(1,1,"Bendahara Umum Daerah",0,0,'C');
            $pdf->SetY(210);
            $pdf->SetX(140);
            $pdf->SetFont('Times','U',11);
            $pdf->Cell(1,1,"HALASSON F SINURAT, SSTP,M.Si",0,0,'C');
            $pdf->SetY(215);
            $pdf->SetX(140);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(1,1,"PEMBINA",0,0,'C');
            $pdf->SetY(220);
            $pdf->SetX(140);
            $pdf->Cell(1,1,"NIP.    198108241999121001",0,0,'C');
            $pdf->SetY(35);
            $pdf->SetX(185);
            $pdf->cell(0,5,'E.',0,0,'L');
            $pdf->SetY(35);
            $pdf->SetX(195);
            $pdf->Multicell(150,5,"Jatah beras dimaksud dalam ayat C untuk sebanyak $j_jatah_beras  kg",0,'L');
            $pdf->SetY(35);
            $pdf->SetX(195);
            $pdf->SetFont('Times','B',11);
            $pdf->Multicell(150,13,"(Dengan huruf : $terbilang )",0,'L');
            $pdf->SetY(40);
            $pdf->SetX(195);
            $pdf->SetFont('Times','',11);
            $pdf->Multicell(150,13,"Telah diberikan/diterima oleh Instansi/Kantor/Satuan Kerja",0,'L');
            $pdf->SetY(45);
            $pdf->SetX(200);
            $pdf->Cell(0,15,"$nm_satkerja",0,1);
            $pdf->SetY(57);
            $pdf->SetX(195);
            $pdf->Multicell(60,5,"Tanda tangan yang diberi wewenang oleh Bendaharawan (Pembuat Daftar Gaji ) untuk menerima jatah beras",0,'L');
            $pdf->SetY(60);
            $pdf->SetX(275);
            $pdf->Multicell(65,5,"..........................................................",0,'C');
            $pdf->SetY(85);
            $pdf->SetX(275);
            $pdf->cell(65,0,"(..........................................................)",0,1,'C');
            $pdf->SetY(68);
            $pdf->SetX(275);
            $pdf->Multicell(65,0,"Kepala DOLOG/SUB DOLOG",0,'C');
            $pdf->SetY(75);
            $pdf->SetX(205);
            $pdf->cell(55,5,"SAHRIYANTI ",0,1,'C');
            $pdf->SetY(75);
            $pdf->SetX(205);
            $pdf->cell(55,15,"PENGATUR MUDA TINGKAT I ",0,1,'C');
            $pdf->SetY(75);
            $pdf->SetX(205);
            $pdf->cell(55,25,"NIP.  198312222010042001 ",0,1,'C');
            $pdf->SetY(90);
            $pdf->SetX(185);
            $pdf->cell(158,1,'','B',10,'R');
            $pdf->SetY(95);
            $pdf->SetX(195);
            $pdf->Cell(60,0,"Tidak dapat diberikan oleh karena tidak ada persediaan beras",0,1,'L');
            $pdf->SetY(95);
            $pdf->SetX(275);
            $pdf->Multicell(65,5,"..........................................................",0,'C');
            $pdf->SetY(110);
            $pdf->SetX(275);
            $pdf->cell(65,20,"(..........................................................)",0,1,'C');
            $pdf->SetY(98);
            $pdf->SetX(275);
            $pdf->Multicell(65,8,"Kepala DOLOG/SUB DOLOG",0,'C');
            $pdf->SetY(123);
            $pdf->SetX(185);
            $pdf->cell(158,1,'','B',10,'R');
            $pdf->SetY(125);
            $pdf->SetX(185);
            $pdf->cell(65,5,"*) Coret yang tidak perlu",0,1,'L');
            $pdf->SetY(130);
            $pdf->SetX(183);
            $pdf->cell(65,5,"**)",0,1,'L');
            $pdf->SetY(130);
            $pdf->SetX(190);
            $pdf->Multicell(165,5,"Nomor urut surat keterangan diisi oleh instansi yang bersangkutan Surat keterangan ini tidak diperkenankan salah tik/tulis/coret-coretan sehingga meragukan Badan penyalur pangan yang bersangkutan dan diajukan tanpa kecuali pada tiap-tiap",0,'L');
            $pdf->SetY(141);
            $pdf->SetX(288);
            $pdf->Cell(0.5,90,'',1,0,'L');
            $pdf->SetY(141);
            $pdf->SetX(290);
            $pdf->Multicell(45,5,"Lembar ke I s/d IV setelah diperiksa dan ditandatangani oleh Biro Keuangan / Bagian Keuangan / Penerbit SPMU gaji dan Kepala Kantor Kas Negara di kembalikan kepada Bendaharawan untuk di pergunakan dalam mengambil jatah beras (lembar ke I s/d lembar ke III) dan lembar ke IV diteruskan ke KPB. Lembar ke IV sebagai Biro Keuangan Daerah Otonom",0,'J');
            $pdf->SetY(140);
            $pdf->SetX(190);
            $pdf->cell(65,14,"bulan yang berkenaan.",0,1,'L');
            $pdf->SetY(145);
            $pdf->SetX(190);
            $pdf->cell(65,13,"Lembar I:",0,1,'L');
            $pdf->SetY(153);
            $pdf->SetX(190);
            $pdf->Multicell(95,4,"Untuk Depot Logistik untuk dipergunakan sebagai lampiran ''Daftar penyimpulan penyaluran beras'' dan ''Surat permintaan pembayaran harga jatah beras'' kepada KPN yang bersangkutan disusun per Satuan Kerja/Pembuat Daftar Gaji/Bendaharawan Gaji pada provinsi/Kab/Kodya bersangkutan",0,'J');
            $pdf->SetY(177);
            $pdf->SetX(190);
            $pdf->cell(65,3,"Lembar II:",0,1,'L');
            $pdf->SetY(180);
            $pdf->SetX(190);
            $pdf->Multicell(95,6,"Untuk Depot Logistik sebagai pertinggal",0,'J');
            $pdf->SetY(186);
            $pdf->SetX(190);
            $pdf->cell(65,3,"Lembar III:",0,1,'L');
            $pdf->SetY(187);
            $pdf->SetX(190);
            $pdf->Multicell(95,10,"Untuk Bendaharawan sebagai pertinggal",0,'J');
            $pdf->SetY(196);
            $pdf->SetX(190);
            $pdf->cell(65,0,"Lembar IV",0,1,'L');
            $pdf->SetY(199);
            $pdf->SetX(190);
            $pdf->Multicell(95,4,"Untuk Kantor Perbendaharaan Negara",0,'J');
            $pdf->SetY(205);
            $pdf->SetX(190);
            $pdf->cell(65,0,"Lembar V:",0,1,'L');
            $pdf->SetY(207);
            $pdf->SetX(190);
            $pdf->Multicell(110,4,"Untuk Depot Logistik (Langsung dikirim oleh Biro Keuangan/Bagian Keuangan sebagai surat penguji",0,'L');
            $pdf->SetY(215);
            $pdf->SetX(190);
            $pdf->cell(65,4,"Lembar VI:",0,1,'L');
            $pdf->SetY(220);
            $pdf->SetX(190);
            $pdf->Multicell(95,4,"Untuk pertinggal Biro Keuangan/Bagian Keuangan/Penerbit SPMU Beras",0,'J');
            $pdf->Output();

    }
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pph extends CI_Controller {

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

    function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font='',$skpd='',$orientasi) {
        ob_clean();
        ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('','Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";

        $mpdf->pdf->AddPage('L','','','','',10,1,1,0);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

    public function getConfig()
    {
        $this->db->from('config');
        $query = $this->db->get();
        if ( $query->result() > 0 ) {

            foreach ( $query->result() as $key ) {
                $data = array(
                    'nm_daerah'         => $key->cona,                                                                  
                    'nm_kepala'         => $key->kep,                                                               
                    'nip1'              => $key->nipkep,                                                                
                    'nm_sekda'          => $key->nmsekda,
                    'nip2'              => $key->nipsekda,
                    'telepon'           => $key->phone,
                    'thn'               => $key->thang,
                    'kota'              => $key->kota,
                    'alamat'            => $key->address,
                    'periode'           => $key->periode
                );
            }

        } else {

            $data = 'Null';

        }
        $query->free_result();
        return $data;
    }

    function  getBulanIndo2($bln){
        switch  ($bln){
        case  '1':
        return  "Januari";
        break;
        case  '2':
        return  "Februari";
        break;
        case  '3':
        return  "Maret";
        break;
        case  '4':
        return  "April";
        break;
        case  '5':
        return  "Mei";
        break;
        case  '6':
        return  "Juni";
        break;
        case  '7':
        return  "Juli";
        break;
        case  '8':
        return  "Agustus";
        break;
        case  '9':
        return  "September";
        break;
        case  '10':
        return  "Oktober";
        break;
        case  '11':
        return  "November";
        break;
        case  '12':
        return  "Desember";
        break;
        }
    }


    public function pph(){

         $sqlttd1="SELECT nama,nip,jabatan FROM ttd where ckey='BUD'";
        $sqlttd=$this->db->query($sqlttd1);
        foreach ($sqlttd->result() as $rowttd)
        {
            $nipbud=$rowttd->nip;                    
            $namabud= $rowttd->nama;
            $jabatanbud  = $rowttd->jabatan;
        }
    	
    	if (isset($_POST['kd_skpd1'])) {
            $config = $this->getConfig();
            $nm_daerah   = strtoupper($config['nm_daerah']);
            $tahun    = strtoupper($config['thn']);
            $kota    = $config['kota'];
            $periode    = $config['periode'];
            $bulan  = $this->getBulanIndo2($periode);
            $tanggal = date("d");
            $bln = date("m");
            $c_bulan = $this->bulan($bln);
            $skpd1 = $_POST['kd_skpd1'];
            $cRet = '';
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                    <tr>
                        <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align=\"center\" width=\"10\" rowspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&nbsp;</td>
                        <td align=\"center\" width=\"80\" style=\"font-size:12px;border: solid 1px white;\">DAFTAR REKAPITULASI</td>
                        <td align=\"left\" width=\"10\" rowspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">LAMPIRAN IV :<br>SEB DJA - PUMDA <br> TGL. 29 DESEMBER 2000 <br> NO. SE - 199/A/2000 <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SE - 845.I/2233/PUMDA2000</td>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"font-size:12px;border: solid 1px white;\">HASIL PEMUNGUTAN IURAN PAJAK PENGHASILAN PEGAWAI NEGERI SIPIL DAERAH</td>
                    </tr>
                    ";
                    $cRet.="</table>";
            $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                    <tr>
                        <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">PROP/KAB/KOTA : PEMERINTAH KABUPATEN $nm_daerah</td>
                    </tr>
                    <tr>
                        <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">BULAN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $bulan $tahun</td>
                    </tr>
                    ";
                    $cRet.="</table>";
             $cRet .="<table style=\"border-collapse:collapse; border-color: black;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" >
                    <thead> 
                    <tr>
                        <td align=\"center\" rowspan=\"2\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >No</td>
                        <td align=\"center\" rowspan=\"2\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >NAMA DINAS / INSTANSI SATKER</td>
                        <td align=\"center\" colspan=\"4\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >POTONGAN PPH PER GOLONGAN (Rp)</td>
                        <td align=\"center\" rowspan=\"2\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >JUMLAH</td>
                    </tr>
                    <tr>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL I</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL II</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL III</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL IV</td>
                    </tr>
                    <tr>
                        <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >1</td>
                        <td align=\"center\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >2</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >3</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >4</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >5</td>
                        <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >6</td>
                        <td align=\"center\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >7</td>
                    </tr>
                    </thead>"; 

                    $sql = "SELECT a.satkerja,a.nm_satkerja,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '1' ) as gol_1,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '2' ) as gol_2,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '3' ) as gol_3,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '4' ) as gol_4
                        from satkerja a where a.satkerja = '$skpd1'";

                    $pph = $this->db->query($sql)->result();
                    $no = 0;
                    foreach ($pph as $row){
                         $no++;
                         $nm_satkerja = $row->nm_satkerja;
                         $golongan_1 = $row->gol_1;
                         $j_golongan_1 = number_format($golongan_1 ,2,',','.');
                         $golongan_2 = $row->gol_2;
                         $j_golongan_2 = number_format($golongan_2 ,2,',','.');
                         $golongan_3 = $row->gol_3;
                         $j_golongan_3 = number_format($golongan_3 ,2,',','.');
                         $golongan_4 = $row->gol_4;
                         $j_golongan_4 = number_format($golongan_4 ,2,',','.');
                         $jumlah = $golongan_1 + $golongan_2 + $golongan_3 + $golongan_4;
                         $jumlah1 = number_format($jumlah,2,',','.');                   

                        $cRet .= " <tr>
                                <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$no</td>
                                <td align=\"left\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$nm_satkerja</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_1</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_2</td>                
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_3</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_4</td>
                                <td align=\"right\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$jumlah1</td> 
                                </tr>"; 
                    }
                        $cRet .= " <tr>
                                <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" ></td>
                                <td align=\"center\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >JUMLAH KESELURUHAN</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_1</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_2</td>                
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_3</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_4</td>
                                <td align=\"right\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$jumlah1</td> 
                                </tr>";

                $cRet .="</table>"; 

                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>
        
                        </tr>
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">$kota, $tanggal $c_bulan $tahun </td>
        
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td> 
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">$jabatanbud</td>
            
                        </tr> 
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\"><u>$namabud</u></td>       
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">NIP. $nipbud</td>      
                        </tr> ";

                    $cRet .="</table>";
                $data['prev']= $cRet;
                $judul  = 'Laporan Rekap PPH' .'-'. $nm_satkerja;
                if (isset($_POST['cetak'])) {
                        $this->_mpdf('',$cRet,'','','',8,0,0,0);
                    }else{
                        header("Cache-Control: no-cache, no-store, must-revalidate");
                        header("Content-Type: application/vnd.ms-excel");
                        header("Content-Disposition: attachment; filename= $judul.xls");
                        $this->load->view('transaksi/excel', $data);
                    }          
        }else{
                $config = $this->getConfig();
                $nm_daerah   = strtoupper($config['nm_daerah']);
                $tahun    = strtoupper($config['thn']);
                $kota    = $config['kota'];
                $periode    = $config['periode'];
                $bulan  = $this->getBulanIndo2($periode);
                $tanggal = date("d");
                $bln = date("m");
                $c_bulan = $this->bulan($bln);
                $cRet = '';
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                        <tr>
                            <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align=\"center\" width=\"10\" rowspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">&nbsp;</td>
                            <td align=\"center\" width=\"80\" style=\"font-size:12px;border: solid 1px white;\">DAFTAR REKAPITULASI</td>
                            <td align=\"left\" width=\"10\" rowspan=\"2\" style=\"font-size:12px;border: solid 1px white;\">LAMPIRAN IV :<br>SEB DJA - PUMDA <br> TGL. 29 DESEMBER 2000 <br> NO. SE - 199/A/2000 <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SE - 845.I/2233/PUMDA2000</td>
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;border: solid 1px white;\">HASIL PEMUNGUTAN IURAN PAJAK PENGHASILAN PEGAWAI NEGERI SIPIL DAERAH</td>
                        </tr>
                        ";
                        $cRet.="</table>";
                $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                        <tr>
                            <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">PROP/KAB/KOTA : PEMERINTAH KABUPATEN $nm_daerah</td>
                        </tr>
                        <tr>
                            <td align=\"left\" width=\"100\" style=\"font-size:12px;border: solid 1px white;\">BULAN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $bulan $tahun</td>
                        </tr>
                        ";
                        $cRet.="</table>";
                 $cRet .="<table style=\"border-collapse:collapse; border-color: black;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" >
                        <thead> 
                        <tr>
                            <td align=\"center\" rowspan=\"2\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >No</td>
                            <td align=\"center\" rowspan=\"2\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >NAMA DINAS / INSTANSI SATKER</td>
                            <td align=\"center\" colspan=\"4\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >POTONGAN PPH PER GOLONGAN (Rp)</td>
                            <td align=\"center\" rowspan=\"2\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >JUMLAH</td>
                        </tr>
                        <tr>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL I</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL II</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL III</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >GOL IV</td>
                        </tr>
                        <tr>
                            <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >1</td>
                            <td align=\"center\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >2</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >3</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >4</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >5</td>
                            <td align=\"center\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >6</td>
                            <td align=\"center\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >7</td>
                        </tr>
                        </thead>"; 

                       $sql = "SELECT a.satkerja,a.nm_satkerja,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '1' ) as gol_1,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '2' ) as gol_2,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '3' ) as gol_3,
                        (select sum(pph) from public.pegawai b where b.satkerja=a.satkerja and left(b.golongan,1) = '4' ) as gol_4
                        from satkerja a order by a.satkerja";

                        $pph = $this->db->query($sql)->result();
                        $no = 0;
                        $tot_golongan_1 = 0;
                        $tot_golongan_2 = 0;
                        $tot_golongan_3 = 0;
                        $tot_golongan_4 = 0;
                        $tot_jumlah = 0;
                        foreach ($pph as $row){
                             $no++;
                             $nm_satkerja = $row->nm_satkerja;
                             $golongan_1 = $row->gol_1;
                             $j_golongan_1 = number_format($golongan_1 ,2,',','.');
                             $golongan_2 = $row->gol_2;
                             $j_golongan_2 = number_format($golongan_2 ,2,',','.');
                             $golongan_3 = $row->gol_3;
                             $j_golongan_3 = number_format($golongan_3 ,2,',','.');
                             $golongan_4 = $row->gol_4;
                             $j_golongan_4 = number_format($golongan_4 ,2,',','.');
                             $jumlah = $golongan_1 + $golongan_2 + $golongan_3 + $golongan_4;
                             $jumlah1 = number_format($jumlah,2,',','.'); 

                            $tot_golongan_1 = $tot_golongan_1 + $golongan_1 ; 
                            $tot_j_golongan_1 = number_format($tot_golongan_1 ,2,',','.');
                            $tot_golongan_2 = $tot_golongan_2 + $golongan_2 ; 
                            $tot_j_golongan_2 = number_format($tot_golongan_2 ,2,',','.');
                            $tot_golongan_3 = $tot_golongan_3 + $golongan_3 ; 
                            $tot_j_golongan_3 = number_format($tot_golongan_3 ,2,',','.');
                            $tot_golongan_4 = $tot_golongan_4 + $golongan_4 ; 
                            $tot_j_golongan_4 = number_format($tot_golongan_4 ,2,',','.');
                            $tot_jumlah     = $tot_jumlah     + $jumlah     ;  
                            $tot_j_jumlah = number_format($tot_jumlah ,2,',','.');         

                            $cRet .= " <tr>
                                <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$no</td>
                                <td align=\"left\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$nm_satkerja</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_1</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_2</td>                
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_3</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$j_golongan_4</td>
                                <td align=\"right\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$jumlah1</td>  
                                </tr>"; 
                        }
                            $cRet .= " <tr>
                                <td align=\"center\" width=\"5%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" ></td>
                                <td align=\"center\" width=\"40%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >JUMLAH KESELURUHAN</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$tot_j_golongan_1</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$tot_j_golongan_2</td>                
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$tot_j_golongan_3</td>
                                <td align=\"right\" width=\"10%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$tot_j_golongan_4</td>
                                <td align=\"right\" width=\"15%\" style=\"font-size:12px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\" >$tot_j_jumlah</td> 
                                </tr>"; 

                    $cRet .="</table>"; 

                    $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>
        
                        </tr>
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">$kota, $tanggal $c_bulan $tahun </td>
        
                        </tr>
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td> 
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">$jabatanbud</td>
            
                        </tr> 
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                         <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\">&nbsp;</td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">&nbsp;</td>        
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\"><u>$namabud</u></td>       
                        </tr> 
                        <tr>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>                    
                            <td align=\"center\" style=\"font-size:12px;\" width=\"25%\"></td>
                            <td align=\"center\" style=\"font-size:12px;\" width=\"50%\">NIP. $nipbud</td>      
                        </tr> ";

                    $cRet .="</table>";
                    $data['prev']= $cRet;
                    $judul  = 'Laporan Rekap PPH Keseluruhan';
                    if (isset($_POST['cetak'])) {
                        $this->_mpdf('',$cRet,'','','',8,0,0,0);
                    }else{
                        header("Cache-Control: no-cache, no-store, must-revalidate");
                        header("Content-Type: application/vnd.ms-excel");
                        header("Content-Disposition: attachment; filename= $judul.xls");
                        $this->load->view('transaksi/excel', $data);
                    }
        }
    }
}

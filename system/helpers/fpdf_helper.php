<?php
define('FPDF_FONTPATH', 'font/');
require(APPPATH.'libraries/Fpdf.php');

class reportProduct extends CI_Fpdf
{
  var $widths;
  var $aligns;

function SetWidths($w)
{
  $this->widths=$w;
}

function SetAligns($a)
{
  $this->aligns=$a;
}

function Row($data)
{
  $nb=0;
  for($i=0;$i<count($data);$i++)
    $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	/* if($nb>3){
	$xnb=4;//($nb-10);	
	}else{
	$xnb=$nb;} */
  $h=(4*$nb);
  $this->CheckPageBreak($h);
  for($i=0;$i<count($data);$i++)
  {
   $w=$this->widths[$i];
   $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
   $x=$this->GetX();
   $y=$this->GetY();
   $this->Rect($x,$y,$w,$h);
   //$pdf->Cell(width, height, text, border, position-next-cell, alignment);
   $this->MultiCell($w,4,$data[$i],0,$a);
   $this->SetXY($x+$w,$y);
  }
  $this->Ln($h);
}


function SetFillColor($r, $g=null, $b=null)
{
	// Set color for all filling operations
	if(($r==0 && $g==0 && $b==0) || $g===null)
		$this->FillColor = sprintf('%.3F g',$r/255);
	else
		$this->FillColor = sprintf('%.3F %.3F %.3F rg',$r/255,$g/255,$b/255);
	$this->ColorFlag = ($this->FillColor!=$this->TextColor);
	if($this->page>0)
		$this->_out($this->FillColor);
}

function CheckPageBreak($h)
{
  if($this->GetY()+$h>$this->PageBreakTrigger)
  $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
  $cw=&$this->CurrentFont['cw'];
  if($w==0)
   $w=$this->w-$this->rMargin-$this->x;
  $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
  $s=str_replace("r",'',$txt);
  $nb=strlen($s);
  if($nb>0 and $s[$nb-1]=="n")
   $nb--;
  $sep=-1;
  $i=0;
  $j=0;
  $l=0;
  $nl=1;
  while($i<$nb)
  {
   $c=$s[$i];
   if($c=="n")
   {
    $i++;
    $sep=-1;
    $j=$i;
    $l=0;
    $nl++;
    continue;
   }
   if($c==' ')
    $sep=$i;
   $l+=$cw[$c];
   if($l>$wmax)
   {
    if($sep==-1)
    {
     if($i==$j)
      $i++;
    }
    else
     $i=$sep+1;
    $sep=-1;
    $j=$i;
    $l=0;
    $nl++;
   }
   else
   $i++;
 }
 return $nl;
}

function Header()
{
	
    /* // Select Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20); */

}

function Footer()
{
  //Position at 1.5 cm from bottom
  $this->SetY(-15);
  //Arial italic 8
  $this->SetFont('Arial','',6);
  //Page number
  $this->Cell(0,10,'Printed By Simbakda Akrual @'.date('Y-m-d H:m:s'),0,0,'L');
  $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
}

public function setKriteria($i)
{
  $this->kriteria=$i;
}

public function getKriteria()
{
  return $this->kriteria;
}

public function setNama($n)
{
  $this->nama=$n;
}

public function getNama()
{
  return $this->nama;
}

public function setDataset($n)
{
  $this->dataset=$n;
}

public function getDataset()
{
  return $this->dataset;
}

}

?>

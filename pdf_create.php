<?php  if(!isset($_POST['submit'])){  ?>


<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
 <div class="field">   
  Brandname:
    <input type="text" name="Brandname" id="Brandname">
	<br>
	</div>
	<br>
	<div class="field">   
  Company:
    <input type="text" name="Company" id="Company">
	<br>
	</div>
	<br>
	<div class="field">   
    Vat:
    <input type="text" name="Vat" id="Vat">
	<br>
	</div>
	<br>
	<div class="field">   
    Address:
    <input type="text" name="Address" id="Address">
	<br>
	</div>
	<br>
	<div class="field">   
    Tel:
    <input type="text" name="Tel" id="Tel">
	<br>
	</div>
	<br>
	<div class="field">   
    Email:
    <input type="text" name="Email" id="Email">
	<br>
	</div>
	<br>
	<div class="field">   
    Register:
    <input type="text" name="Register" id="Register">
	<br>
	</div>
	<br>
	<div class="field">   
    Descripcion:
    <textarea name="Descripcion" id="Descripcion" rows="10"></textarea>
	<br>
	</div>
	<br>
	<div class="field">   
    DPD:
    <input type="text" name="dpd" id="dpd">
	<br>
	</div>
	<br>
	<div class="field">   
   Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
	</div>
    <input type="submit" value="Save" name="submit">
</form>

</body>
</html>

<?php  }elseif(isset($_POST['submit'])){
	ini_set('max_execution_time', 1000); //300 seconds = 5 minutes
	$fileName = $_FILES['fileToUpload']['name']."_".time();
    $filePath = "images/" . $fileName;
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$filePath);
	
	$Brandname=$_POST['Brandname'];
	$Company=$_POST['Company'];
	$Vat=$_POST['Vat'];
	$Address=$_POST['Address'];
	$Tel=$_POST['Tel'];
	$Email=$_POST['Email'];
	$Register=$_POST['Register'];
	$Descripcion=$_POST['Descripcion'];
	$dpd=$_POST['dpd'];
	include("content.php");


$Contents = str_replace('[brandname]', $Brandname, $content);

$Contents = str_replace('[COMPANY]', $Company, $Contents);

$Contents = str_replace('[VAT]', $Vat, $Contents);

$Contents = str_replace('[address]', $Address, $Contents);
$Contents = str_replace('[dpd]', $dpd, $Contents);
$Contents = str_replace('[tel]', $Tel, $Contents);
$Contents = str_replace('[email]', $Email, $Contents);
$Contents = str_replace('[register]', $Register, $Contents);
$Contents = str_replace('[description]', $Descripcion, $Contents);
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
/* $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');  */

// set default header data
$pdf->SetHeaderData($fileName, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'example/lang/eng.php')) {
	require_once(dirname(__FILE__).'example/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD


<div  style="width:100%; margin:200px 100px 50px 0;text-align:center">
<div class="form-group">
$Brandname
</div>
</div>



<div class="col-md-6">
<div class="form-group">
Responsable del tratamiento [$Company] CIF [$Vat] <BR>
[$Address]<BR>
Teléfono [$Tel] email [$Email]
</div>
</div>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
$html2 = <<<EOD
$Contents


EOD;
$pdf->AddPage();
// print a block of text using Write()
$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);


// ---------------------------------------------------------


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
//$pdf->Output('example_001.pdf', 'I');
$pdfpath="/pdf/$Brandname-".time().".pdf";
$pdf->Output(dirname(__FILE__).$pdfpath, 'F');
if(file_exists(dirname(__FILE__).$pdfpath)){
echo "File Save in Folder: ".$pdfpath;
}
unlink($filePath);
//============================================================+
// END OF FILE
//============================================================+
} 
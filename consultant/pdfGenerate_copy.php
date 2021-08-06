<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */
require_once("../TCPDF/tcpdf.php");
require_once("../includes/config.php");
require_once("../includes/functions.php");
require_once("../includes/database.php");
require_once("../includes/database_object.php");
require_once("../includes/waiting_list.php");
require_once("../includes/patient.php");
require_once("../includes/refer_admission.php");
require_once("../includes/user.php");

$waiting_list = WaitingList::find_by_id($_GET['id']);
$patient = Patient::find_by_id($waiting_list->patient_id);
$userConsult = User::find_by_department("Consultancy");
// echo "<pre>";
// print_r($patient);die;
// create new PDF document
$refAdmissionDetail = ReferAdmission::find_by_bill_id($waiting_list->patient_id);
$refAdmissionDetail = $refAdmissionDetail[0];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Megalek Hospital');
$pdf->SetTitle('Admission Ticket');
$pdf->SetSubject('Admission Ticket');

// set default header data
$pdf->SetheaderData("", "70", "Megalek Hospital", "Address:---");

// set header and footer fonts
$pdf->setheaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetheaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
// tdis metdod has several options, check tde source code documentation for more information.
$pdf->AddPage();

// Set some content to print
// $html = <<<EOD
// <table cellspacing="0" cellpadding="1" border="1">
// <tr>
// <td>Title </td>
// <td>$patient->title</td>
// </tr>
// <tr>
// <td>First Name </td>
// <td>$patient->first_name</td>
// </tr>
// <tr>
// <td>Last Name </td>
// <td>$patient->last_name</td>
// </tr>
// <tr>
// <td>Birtd Date</td>
// <td>
// EOD;
// $html .= date('m-d-Y', strtotime($patient->dob));

// $a = <<<EOD 
// </td>
// </tr>
// </table>
// EOD;
$html = '<table border="1" cellspacing="0" cellpadding="5">
<tr>
    <td>Title </td>
    <td>'.$patient->title.'</td>
</tr>
<tr>
    <td>First Name</td>
    <td>'.$patient->first_name.'</td>
</tr>
<tr>
    <td>Last Name</td>
    <td>'.$patient->last_name.'</td>
</tr>
<tr>
    <td>Birtd Date</td>
    <td>'.date('m-d-Y', strtotime($patient->dob)).
'</td>
</tr>
<tr >
    <td>Age</td>
    <td>'.getAge($patient->dob).'year(s)</td>
</tr>
<tr>
    <td>Gender</td>
    <td>'.$patient->gender.'</td>
</tr>
<tr>
<td>Marital Status</td>
<td>'.$patient->marital_status.'</td>
</tr>
<tr >
    <td>Occupation</td>
    <td>'.$patient->occupation.'</td>
</tr>
<tr >
    <td>Nationality</td>
    <td>'.$patient->nationality.'</td>
</tr>
<tr >
    <td>State</td>
    <td>'.$patient->state.'</td>
</tr>
<tr >
    <td>LGA</td>
    <td>'.$patient->lga.'</td>
</tr>
<tr >
    <td>Religion</td>
    <td>'.$patient->religion.'</td>
</tr>
<tr >
    <td>Language(s)</td>
    <td>';
    $html .= isset($patient->english) ? $patient->english . ", " : '';
    $html .= isset($patient->pidgin) ? $patient->pidgin . ", " : '';
    $html .= !empty($patient->hausa) ? $patient->hausa . ", " : '';
    $html .= !empty($patient->yoruba) ? $patient->yoruba . ", " : '';
    $html .= !empty($patient->igbo) ? $patient->igbo . ", " : '';
    $html .= '
    </td>
</tr>

</table>';

$html .= '
<br>
<div style="font-size:20px; ; text-align:center; background-color:gray;"><b>Admission Detail</b></div>
<table border="1" cellspacing="0" cellpadding="5" style="margin-top:10px">
<tr>
    <td>Consultant Dr.</td>';
    $drName = "";
    foreach ($userConsult as $co) {
        if($co->id == $refAdmissionDetail->Consultantdr){
            $drName = ucfirst($co->first_name) . " " . $co->last_name;
            break;
        }else{
            $drName = "";
        } 
    }
 $html .= "<td>$drName</td>
</tr>
<tr>
    <td>Adm. Date & Time</td>
    <td>";
    $html .= date("m-d-Y H:i A", strtotime($refAdmissionDetail->adm_date));
    $html .= "</td>
</tr>
<tr>
    <td>Location</td>
    <td>$refAdmissionDetail->location</td>
</tr>
<tr>
    <td>Ward</td>
    <td>$refAdmissionDetail->ward_no</td>
</tr>
<tr>
    <td>Room Number</td>
    <td>$refAdmissionDetail->room_no</td>
</tr>
<tr>
    <td>Bed Number</td>
    <td>$refAdmissionDetail->bed_no</td>
</tr>
<tr>
    <td>Medical / Surgical</td>
    <td>$refAdmissionDetail->m_s</td>
</tr>
<tr>
    <td>Admission Purpose</td>
    <td>$refAdmissionDetail->adm_purpose</td>
</tr>
<tr>
    <td>Patient Category</td>
    <td>$refAdmissionDetail->pat_category</td>
</tr>
</table>
";



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// tdis metdod has several options, check tde source code documentation for more information.
$pdf->Output('example_065.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
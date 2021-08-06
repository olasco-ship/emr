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
$pdf->SetHeaderData("", "70", "Megalek Hospital", "Address:---");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = '
<div style="font-size:30px; text-align:center">Admission Ticket</div>
<div style="font-size:20px; text-align:center; background-color:gray;"><b >Patient Details</b></div>
<br>
<table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
<tr>
    <th>Title </th>
    <td>'.$patient->title.'</td>
</tr>
<tr>
    <th>First Name</th>
    <td>'.$patient->first_name.'</td>
</tr>
<tr>
    <th>Last Name</th>
    <td>'.$patient->last_name.'</td>
</tr>
<tr>
    <th>Birth Date</th>
    <td>';
    $html .= date('m-d-Y', strtotime($patient->dob));
    $html .= "</td>
</tr>
<tr >
    <th>Age</th>
    <td>";
    $html .= getAge($patient->dob) . 'year(s)';
    $html .= "</td>
</tr>
<tr >
    <th>Gender</th>
    <td>$patient->gender</td>
</tr>
<tr>
<th>Marital Status</th>
<td>$patient->marital_status</td>
</tr>
<tr >
    <th>Occupation</th>
    <td>$patient->occupation</td>
</tr>
<tr >
    <th>Nationality</th>
    <td>$patient->nationality</td>
</tr>
<tr >
    <th>State</th>
    <td>$patient->state</td>
</tr>
<tr >
    <th>LGA</th>
    <td>$patient->lga</td>
</tr>
<tr >
    <th>Religion</th>
    <td>$patient->religion</td>
</tr>
<tr >
    <th>Language(s)</th>
    <td>";

    $html .= !empty($patient->english) ? $patient->english . ", " : '';
    $html .= !empty($patient->pidgin) ? $patient->pidgin . ", " : '';
    $html .= !empty($patient->hausa) ? $patient->hausa . ", " : '';
    $html .= !empty($patient->yoruba) ? $patient->yoruba . ", " : '';
    $html .= !empty($patient->igbo) ? $patient->igbo . ", " : '';
$html .= " </td>
</tr>

</table>
";
$html .= '
<br>
<div style="font-size:20px; ; text-align:center; background-color:gray;"><b>Admission Detail</b></div>
<br>
<table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
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
    <td>In Patient Id</td>
    <td>".$refAdmissionDetail->in_patient_id."</td>
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
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_065.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
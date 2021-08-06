<?php 

require_once("../TCPDF/tcpdf.php");
require_once("../includes/config.php");
require_once("../includes/functions.php");
require_once("../includes/database.php");
require_once("../includes/database_object.php");
require_once("../includes/waiting_list.php");
require_once("../includes/patient.php");
require_once("../includes/refer_admission.php");
require_once("../includes/user.php");
require_once("../includes/testRequest.php");
require_once("../includes/eachTest.php");
require_once("../includes/scanRequest.php");
require_once("../includes/eachScan.php");
require_once("../includes/drugRequest.php");
require_once("../includes/eachDrug.php");
require_once("../includes/product.php");
require_once("../includes/IPDServices.php");
require_once("../includes/IPDServiceLog.php");
require_once("../includes/Discount.php");

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

    $patient_id = $_GET['patient_id'];
    $refAdDetail = ReferAdmission::find_by_bill_id($patient_id);
    if($refAdDetail[0]->discount_status == 1){
        $discountDetail = Discount::find_by_pat_id($patient_id);
    }else{
        $discountDetail = "";
    }
    //pre_d($discountDetail);die;
    
    $refAdDetail = $refAdDetail[0];
    
    $user = Patient::find_by_id_pdf($patient_id);
    //User Detail
    $html .= '
    <div style="font-size:30px; text-align:center">Discharge Sheet</div>
        <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
            <tr>
                <td>Patient Name</td>
                <td>'.$user->first_name. " ". $user->last_name.'</td>
            </tr>
            <tr>
                <td>Patient Email</td>
                <td>'.$user->email.'</td>
            </tr>
            <tr>
                <td>Patient Mobile</td>
                <td>'.$user->phone_number.'</td>
            </tr>
            <tr>
                <td>Patient Gender</td>
                <td>'.$user->gender.'</td>
            </tr>
            <tr>
                <td>Wallet Balance</td>
                <td>'.$refAdDetail->wall_balance.'</td>
            </tr>';
            if (isset($discountDetail)) {
                $html .= '
                    <tr>
                        <td>Discount Amount</td>
                        <td>'.abs($discountDetail->amount).'</td>
                    </tr>';
            }
            $html .= '
        </table>
    ';


    //Lab PDF Generate
    $test_request = TestRequest::find_by_patient_id_report($patient_id);
    $html .= '
    <br>
    <div style="font-size:20px; text-align:center; background-color:gray;"><b >Laboratory Test Investigation</b></div>
    <br>
    <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
    <thead>
        <tr>
            <th>Name Of Investigation</th>
            <th>Date</th>
            <th>Amount</th>
             
        </tr>
    </thead>
    ';
    $totEachRequestAmount = 0;
    $totEachScanAmount = 0;
    $totEachDrugAmount = 0;
    $totEachIPDAmount = 0;
    foreach($test_request as $testData){
        $eachTest = EachTest::find_all_requests_by_test_request_id($testData->id);
        foreach($eachTest as $eachdata){
            $totEachRequestAmount += $eachdata->test_payment_amount;
            $html .= '
                <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    '. $eachdata->test_name .'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.date("d-m-Y", strtotime($eachdata->date)).'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.$eachdata->test_payment_amount.'
                                </label>
                            </div>

                        </td>                        
                    </tr>
           ';
        }
    }
    $html .= '
        <tr >
            <td colspan="2">Total</td>
            <td><label>'.$totEachRequestAmount.'</label></td>
        </tr>
    </thead>
    </table>
    ';


    //Radiologist PDF Generate
    $scan_request = ScanRequest::find_by_patient_id_report($patient_id);
    $html .= '
    <br>
    <br>
    <div style="font-size:20px; text-align:center; background-color:gray;"><b >Radiology/Ultrasound Test Investigation</b></div>
    <br>
    <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
    
        <tr>
            <th>Name Of Investigation</th>
            <th>Date</th>
            <th>Amount</th>           
        </tr>
        
    ';
    foreach($scan_request as $scanData){
        $eachScan = EachScan::find_all_requests_by_test_request_id_pdf($scanData->id);
        foreach($eachScan as $eachdata){
            $totEachScanAmount += $eachdata->test_payment_amount;
            $html .= '
                <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    '. $eachdata->scan_name .'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.date("d-m-Y", strtotime($eachdata->date)).'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.$eachdata->test_payment_amount.'
                                </label>
                            </div>

                        </td>
                        
                    </tr>
           ';
        }
    }
    $html .= '
        <tr>
            <td colspan="2">Total</td>
            <td><label>'.$totEachScanAmount.'</label></td>
        </tr>
    </thead>
    </table>
    ';


    //Drug PDF Generate
    $drug_request = DrugRequest::find_by_patient_id_report($patient_id);
    $html .= '
    <br>
    <div style="font-size:20px; text-align:center; background-color:gray;"><b >Drug Detail</b></div>
    <br>
    <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
    <thead>
        <tr>
            <th>Name Of Investigation</th>
            <th>Date</th>
            <th>Amount</th>                        
        </tr>
        </thead>
    ';
    foreach($drug_request as $drugData){
        $eachDrug = EachDrug::find_all_requests_by_test_request_id_for_drug($drugData->id);
        foreach($eachDrug as $eachdata){
            $totEachDrugAmount += $eachdata->test_payment_amount;
            $html .= '
                <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    '. $eachdata->product_name .'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.date("d-m-Y", strtotime($eachdata->date)).'
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    '.$eachdata->test_payment_amount.'
                                </label>
                            </div>

                        </td>
                    </tr>
           ';
        }
    }
    $html .= '
        <tr>
            <td colspan="2">Total</td>
            <td><label>'.$totEachDrugAmount.'</label></td>
        </tr>
    </thead>
    </table>
    ';


    //IPD services PDF Generate
    $ipd_service = IPDServiceLog::find_by_patient_pdf($patient_id);
    //pre_d($ipd_service);die;
    if (isset($ipd_service)) {
        $html .= '
        <br>
        <div style="font-size:20px; text-align:center; background-color:gray;"><b >IPD Services</b></div>
        <br>
        <table border="1" cellspacing="0" cellpadding="5" style="margin-top:0px;font-size:16px;">
        <thead>
            <tr>
                <th>IPD services</th>
                <th>Date</th>
                <th>Amount</th>                        
            </tr>
            </thead>
        ';
            foreach ($ipd_service as $ipddata) {
                $ipddataDetail = IPDServices::find_by_id($ipddata->ipd_service_id);
                $totEachIPDAmount += $ipddataDetail->daily_charges;
                $html .= '
                    <tr data-id="">
                            <td>
                                <div class="checkbox">
                                    <label>
                                        '. $ipddataDetail->service_name .'
                                    </label>
                                </div>

                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        '.date("d-m-Y", strtotime($ipddata->created)).'
                                    </label>
                                </div>

                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        '.$ipddataDetail->daily_charges.'
                                    </label>
                                </div>

                            </td>
                        </tr>
            ';
            }
            $html .= '
            <tr>
                <td colspan="2">Total</td>
                <td><label>'.$totEachIPDAmount.'</label></td>
            </tr>
        </thead>
        </table>
        ';
    }

    
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

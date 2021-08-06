<?php

require_once("config.php");
require_once("functions.php");
require_once("session.php");
require_once("database.php");
require_once("database_object.php");
require_once("service_result.php");
require_once("user.php");
require_once("patient.php");

require_once("encounter.php");
require_once("Locations.php");
//require_once("PatientBill.php");
require_once("IPDServiceLog.php");
require_once("Settlement.php");
require_once("Discount.php");
require_once("Wards.php");
require_once("Beds.php");
require_once("UserMultiWards.php");
require_once("IPDServices.php");
require_once("CaseNotesNurse.php");
require_once("CaseNotesDoctor.php");
require_once("BedsList.php");
require_once("bill.php");
require_once("category.php");
require_once("product.php");
require_once("productBatch.php");
require_once("productType.php");
require_once("orders.php");
require_once("order_items.php");
require_once("patient_bill.php");
require_once("user_cart.php");
require_once("refer_admission.php");
require_once("cancel_admission.php");
require_once("caseNote.php");
require_once("referrals.php");

require_once("appointment.php");
require_once("pagination.php");


require_once("storage.php");
require_once("dispensed.php");
require_once("notification.php");

require_once("testRequest.php");
require_once('eachTest.php');
require_once('eachScan.php');
require_once("scanRequest.php");
require_once("drugRequest.php");
require_once("eachDrug.php");
require_once("investigation.php");
require_once("vitals.php");


require_once("unit.php");
require_once("testBill.php");
require_once("scanBill.php");


//require_once("testResult.php");
require_once("test.php");
require_once("result.php");
require_once("scanResult.php");
require_once("revenueHead.php");
require_once("clinic.php");
require_once("subClinic.php");
require_once("patient_subClinic.php");
require_once("waiting_list.php");
require_once('rooms.php');
require_once('patient_consult_rooms.php');
require_once('user_sub_clinic.php');



require_once('pharmacy_station.php');
require_once('product_pharmacy_station.php');
require_once('dispenseHistory.php');
require_once('emergency.php');
require_once('enrollee.php');
require_once('enrollee_patient.php');
require_once('enrollee_sub.php');
require_once('lab_service.php');
require_once('radio_service.php');
require_once('drug_service.php');
require_once('AccountHistory.php');
require_once('EmTestRequest.php');   
require_once('labWalkIn.php');
require_once('radWalkIn.php');
require_once('stockIn.php');
require_once('returnedServices.php');
require_once('serviceBooking.php');

require_once('patientUpload.php');
require_once('Admission.php');
require_once('icdStandard.php');
require_once('nurseHistory.php');
require_once('nursingDomain.php');
require_once('nursingClassification.php');
require_once('nursingDiagnosis.php');
require_once('nursingIntervention.php');
require_once ('nhisPlan.php');
require_once ('Complain.php');
require_once ('Examination.php');
require_once ('ExaminationCategory.php');

require_once ('icdCode.php');
require_once ('icdCategory.php');
require_once ('CodedDiagnosis.php');

require_once ('StockItems.php');
require_once ('StockCategory.php');
require_once ('stock_bill.php');
require_once ('StockNotification.php');
require_once ('stockBatch.php');
require_once ('stockDispensed.php');
require_once ('eachItem.php');
require_once ('StoreIn.php');
require_once ('StoreDispenseHistory.php');
require_once ('Station.php');
require_once ('stock_service_result.php');
require_once ('stockRequest.php');
require_once ('stock_service.php');
require_once ('item_store_station.php');
require_once ('transfer.php');
require_once ('used_item.php');
require_once ('ReferenceRange.php');
require_once ('Calendar.php');
require_once ('SurgeryAppointment.php');
require_once ('MedicalReports.php');

/*

require_once("department.php");

require_once("profession.php");


require_once ("consultation.php");

require_once("revenue.php");

require_once("haem.php");
require_once("chem_path.php");

require_once("externalResult.php");



require_once("reminderz.php");
*/





defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? NULL : define('SITE_ROOT', getcwd());










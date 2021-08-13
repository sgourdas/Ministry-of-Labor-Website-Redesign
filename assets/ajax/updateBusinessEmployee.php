<?php
require_once("../../db.php");
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Expects JSON input
$data = json_decode(file_get_contents('php://input'), true);
print_r($data);

$esf_id = $data["esfid"];
$formType = $data["formType"];
$fname = $data["fname"];
$lname = $data["lname"];
$amka = $data["amka"];
$afm = $data["afm"];
$date1 = $data["date1"];
$date2 = $data["date2"];
$check = $data["check"];

if($formType == 'Ενεργός') {
    $formType = 0;
}
else if($formType == 'Πρόσληψη') {
    $formType = 1;
}
else if($formType == 'Απόλυση') {
    $formType = 2;
}
else if($formType == 'Αναστολή') {
    $formType = 3;
}
else if($formType == 'Άδεια Γενικού Σκοπού') {
    $formType = 4;
}
else if($formType == 'Άδεια Ειδικού Σκοπού') {
    $formType = 7;
}
else if($formType == 'Άδεια Γονική') {
    $formType = 5;
}
else if($formType == 'Άδεια Κυοφορίας') {
    $formType = 8;
}
else if($formType == 'Τηλεργασία') {
    $formType = 6;
}

$conn = DbOpenConnection();

if ($check == "1")
{
    $query = "UPDATE BusinessEmployeeForm SET esf_submitTime=NOW(),esf_name='$fname', esf_surname='$lname', esf_amka='$amka', esf_afm='$afm',
        esf_startDate='$date1',esf_endDate=NULL,esf_wst_id='$formType' WHERE esf_id='$esf_id'";
}
else {
    $query = "UPDATE BusinessEmployeeForm SET esf_submitTime=NOW(),esf_name='$fname', esf_surname='$lname', esf_amka='$amka', esf_afm='$afm',
        esf_startDate='$date1',esf_endDate='$date2', esf_wst_id='$formType' WHERE esf_id='$esf_id'";
}

$result = DbExecuteQuery($conn, $query);

if($result == TRUE) {
    echo "Η ενημέρωση ήταν επιτυχής";
}
else {
    echo "Λάθος κατα την εισαγωγή";
}

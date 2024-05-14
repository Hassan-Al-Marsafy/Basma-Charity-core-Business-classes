<?php

$id = $donationId = $donationTypeId = "";
$id_err = $donationId_err = $donationTypeId_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_donationId = trim($_POST["name"]);
    if (empty($input_donationId)) {
        $donationId_err = "Please enter Donation detail Id";
    } else {
        $donationId = $input_donationId;
    }

    $input_donationTypeId = trim($_POST["type"]);
    if (empty($input_donationTypeId)) {
        $donationTypeId_err = "Please enter the Donation type Id";
    } else {
        $donationTypeId = $input_donationTypeId;
    }

    if (empty($donationId_errr) && empty($donationTypeId_err)) {
        require_once '../strategy/CRUDdonDetails.php';
        require_once '../model/donationDetails.php';
        $Dondetail = new CRUDdonDetails($donationId,$donationTypeId,$quantity,$pdo);
        $createDondetail = new donationDetails();
        $detail = $createDondetail->setDonDetail($Dondetail);
        if ($detail->insert()) {
            header("location: ../index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}

?>
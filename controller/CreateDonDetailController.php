<?php

$donationquantity = $donationId = $donationTypeId = "";
$donationquantity_err = $donationId_err = $donationTypeId_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_donationId = trim($_POST["donationId"]);
    if (empty($input_donationId)) {
        $donationId_err = "Please enter Donation detail Id";
    } else {
        $donationId = $input_donationId;
    }

    $input_donationTypeId = trim($_POST["donationTypeId"]);
    if (empty($input_donationTypeId)) {     
        $donationTypeId_err = "Please enter the Donation type Id";
    } else {
        $donationTypeId = $input_donationTypeId;
    }
    
    $input_donationquantity = trim($_POST["donationquantity"]);
    if (empty($input_donationquantity)) {     
        $donationquantity_err = "Please enter the Donation quantity";
    } else {
        $donationquantity = $input_donationquantity;
    }


    if (empty($donationId_err) && empty($donationTypeId_err) && empty($donationquantity_err)) {
        require_once '../strategy/CRUDdonDetails.php';
        require_once '../model/CRUDmodel.php';
        
        $Dondetail = new CRUDmodel();
        $Dondetail->setOperation(new CRUDdonDetails($donationId,$donationTypeId,$donationquantity));

        if ($Dondetail->insertOperation()) {
            header("location: ../view/ChooseDonDetailsCRUD.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}

?>
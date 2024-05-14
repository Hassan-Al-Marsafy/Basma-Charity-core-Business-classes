<?php
$id = $donationquantity = $donationId = $donationTypeId = "";
$id_err = $donationquantity_err = $donationId_err = $donationTypeId_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    
    $input_id = trim($_POST["id"]);
    if (empty($input_id)) {
        
        $id_err = "Please enter Id.";

    } else {
        $id = $input_id;
    }

    $input_donationId = trim($_POST["donationId"]);
    if (empty($input_donationId)) {
        
        $donationId_err = "Please enter  donation Id.";

    } else {
        $donationId = $input_donationId;
    }

    $input_donationTypeId = trim($_POST["donationTypeId"]);
    if (empty($input_donationTypeId)) {
        $donationTypeId_err = "Please enter  donation type Id.";
    } else {
        $donationTypeId = $input_donationTypeId;
    }

    $input_donationquantity = trim($_POST["donationquantity"]);
    if (empty($input_donationquantity)) {
        $donationquantity_err = "Please enter  quantity.";
    } else {
        $donationquantity = $input_donationquantity;
    }
}
    if (empty($id_err) && empty($donationquantity_err) && empty($donationId_err) && empty($donationTypeId_err)) {
        require_once '../strategy/CRUDdonDetails.php';
        require_once '../model/donationDetails.php';
        $updatedon =    new CRUDdonDetails($donationId,$donationTypeId,$donationquantity,$pdo);
        $updateDondetail = new donationDetails();
        $detail = $updateDondetail->setDonDetail($updatedon);
        if ($detail->update($id, $donationId, $donationTypeId, $donationquantity)) {
            header("location: ../home.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    
    }


?>
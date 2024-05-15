<?php
require_once '../model/db_connect.php'; 
require_once '../strategy/CRUDdonDetails.php';
require_once '../model/donationDetails.php';

$id = "";
$id_err = "";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    if (empty($id_err)) {
        try {
            $crudDonDetails = new CRUDdonDetails('', '', '', $pdo); 
 $donationDetails = new DonationDetails();
 $donationDetails->setDonDetail($crudDonDetails);
            $row = $donationDetails->read($id);

            if (!empty($row)) {
                
                header("Location: ../View/OutputReadDonationDetailsView.php?id=" . urlencode($row["id"]) . "&donationId=" . urlencode($row["donation_id"]) . "&donationTypeId=" . urlencode($row["donationType_id"]) . "&quantity=" . urlencode($row["quantity"]));
                exit();
            } else {
                echo "Donation Details not found.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid ID.";
}
?>

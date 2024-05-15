<?php
require_once '../model/db_connect.php'; // Assuming this file contains the database connection
require_once '../strategy/CRUDdonType.php';
require_once '../model/donationType.php';

$id = "";
$id_err = "";

// Check if the ID is set in the GET request
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    if (empty($id_err)) {
        try {
            $crudDonType = new CRUDdonType($type, $pdo);
            $donationType = new DonationType();
            $donationType->setDonType($crudDonType);
            $row = $donationType->readDonType($id);

            if (!empty($row)) {
                // Pass the data to the view
                header("Location: ../view/OutputReadDonationTypeView.php?id=" . urlencode($row["id"]) . "&type=" . urlencode($row["D_type_name"]));
                exit();
            } else {
                echo "Donation Type not found.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid ID.";
}
?>
<?php
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]); 

    if ($id <= 0) {
        $error_message = "Invalid ID provided.";
    } else {
        require_once '../model/db_connect.php'; 
        require_once '../strategy/CRUDdonType.php';
        require_once '../model/donationType.php';


        $crudDonType = new CRUDdonType('', $pdo); 
        $donationType = new DonationType();
        $donationType->setDonType($crudDonType);

        if ($donationType->deleteDonType($id)) {
            header("location: ../home.php");
            exit();
        } else {

            header("location: ../home.php?error=delete_failed");

        }
    }
} elseif (empty(trim($_GET["id"]))) {

    header("location: error.php");

}
?>


<?php
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
  $id = intval($_POST["id"]);

  if ($id <= 0) {
    $error_message = "Invalid ID provided.";
  } else {
    require_once '../model/db_connect.php';
    require_once '../strategy/CRUDdonDetails.php';
    require_once '../model/donationDetails.php';


    $crudDonDetails = new CRUDdonDetails('', '', '', $pdo);
    $donationDetails = new DonationDetails();
    $donationDetails->setDonDetail($crudDonDetails);



    if ($donationDetails->delete($id)) {
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
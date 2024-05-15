<?php
$date = $user_id = $accountant_id =$manager_id = "";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    require_once '../model/CRUDmodel.php';
    require_once '../model/db_connect.php';
    require_once '../strategy/CRUDdonation.php';
  
    $Donation = new CRUDmodel();  
    $Donation->setOperation(new CRUDdonation($date, $user_id, $accountant_id, $manager_id));
    $don= $Donation->deleteOperation($id);
    
  //  $delete = new DeleteClass();
    if ($don) {
        header("location: ../view/ChooseDonationCRUD.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }
} else {
    if (empty(trim($_GET["id"]))) {
        header("location: error.php");
        exit();
    }
}
?>

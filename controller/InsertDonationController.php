<?php
//$name = $user_name = $user_type = "";
$date = $user_id = $accountant_id =$manager_id = "";
$date_err = $user_id_err = $accountant_id_err = $manager_id_err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Please enter a date.";
    } else {
        $date = $input_date;
    }

    $input_user_id = trim($_POST["user_id"]);
    if (empty($input_user_id)) {
        $user_id_err = "Please enter a user_id.";
    } else {
        $user_id = $input_user_id;
    }

    $input_accountant_id = trim($_POST["accountant_id"]);
    if (empty($input_accountant_id)) {
        $accountant_id_err = "Please enter the accountant_id.";
    } else {
        $accountant_id = $input_accountant_id;
    }

    $input_manager_id = trim($_POST["manager_id"]);
    if (empty($input_manager_id)) {
        $manager_id_err = "Please enter the manager_id.";
    } else {
        $manager_id = $input_manager_id;
    }

    if (empty($date_err) && empty($user_id_err) && empty($accountant_id_err) && empty($manager_id_err)) {
        require_once '../model/CRUDmodel.php';
        require_once '../model/db_connect.php';
        require_once '../strategy/CRUDdonation.php';
        $Donation = new CRUDmodel();
        $Donation->setOperation(new CRUDdonation($date, $user_id, $accountant_id, $manager_id));
        if($Donation->insertOperation()){

          header("location: ../view/ChooseDonationCRUD.php");
        }
        else {
          echo "Something Went Wrong";
        }
    }
}
?>
<?php

$type = $id = "";
$type_err = $id_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_id = trim($_POST["id"]);
    if (empty($input_id)) {
        $id_err = "Please enter a id.";
    } else {
        $id = $input_id;
    }

    $input_type = trim($_POST["type"]);
    if (empty($input_type)) {
        $type_err = "Please enter a type.";
    } else {
        $type = $input_type;
    }

    if (empty($type_err) && empty($id_err)) {
        
        require_once '../strategy/CRUDdonType.php';
        require_once '../model/donationType.php';
        
        $crudDonType = new CRUDdonType($type, $pdo);
        $donationType = new DonationType();
        $donationType->setDonType($crudDonType);

        if ($donationType->updateDonType($id, $input_type)) {
            header("location: ../home.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}

?>
<?php 

$type ="";
$type_err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_type = trim($_POST["type"]);
    if (empty($input_type)) {
        $type_err = "Please enter a type.";
    } else {
        $type = $input_type;
    }

    if (empty($type_err)) {
        require_once '../strategy/CRUDdonType.php';
        require_once '../model/donationType.php';

        $crudDonType = new CRUDdonType($type, $pdo);
        $donationType = new DonationType();
        $donationType->setDonType($crudDonType);

        if ($donationType->insertDonType()){
            header("location: /index.php");
        } else {
            echo "Something went wromg. Please try again.";
        }
    }
}

?>
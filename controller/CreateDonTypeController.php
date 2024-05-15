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
        require_once '../model/CRUDmodel.php';
        require_once '../model/db_connect.php';
        require_once '../strategy/CRUDdonType.php';
        
        $DonType = new CRUDmodel();
        $DonType->setOperation(new CRUDdonType($type));

        if ($DonType->insertOperation()){
            header("location: ../view/ChooseDonTypeCRUD.php");
        } else {
            echo "Something went wromg. Please try again.";
        }
    }
}

?>
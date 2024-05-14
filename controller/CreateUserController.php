<?php

$id = $user_name = $user_type = "";
$id_err = $user_name_err = $user_type_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_user_name = trim($_POST["name"]);
    if (empty($input_user_name)) {
        $user_name_err = "Please enter an user_name.";
    } else {
        $user_name = $input_user_name;
    }

    $input_user_type = trim($_POST["type"]);
    if (empty($input_user_type)) {
        $user_type_err = "Please enter the user_type.";
    } else {
        $user_type = $input_user_type;
    }

    if (empty($user_name_err) && empty($user_type_err)) {
        require_once '../strategy/CRUDuser.php';
        $createUser = new CRUDuser($user_name , $user_type , $pdo);
        if ($createUser->insert()) {
            header("location: ../index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
?>
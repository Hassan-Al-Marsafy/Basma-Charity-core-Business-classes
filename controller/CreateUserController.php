<?php

$name = $user_name = $user_type = "";
$name_err = $user_name_err = $user_type_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    $input_user_name = trim($_POST["username"]);
    if (empty($input_user_name)) {
        $user_name_err = "Please enter a user_name.";
    } else {
        $user_name = $input_user_name;
    }

    $input_user_type = trim($_POST["type"]);
    if (empty($input_user_type)) {
        $user_type_err = "Please enter the user_type.";
    } else {
        $user_type = $input_user_type;
    }

    if (empty($name_err) && empty($user_name_err) && empty($user_type_err)) {
        require_once '../model/CRUDmodel.php';
        require_once '../model/db_connect.php';
        require_once '../strategy/CRUDuser.php';
        $User = new CRUDmodel();
        $User->setOperation(new CRUDuser($user_name, $user_type, $name, $pdo));
        if ($User->insertOperation()) {
            header("location: ../index.php");
        } else {
            $user_name_err = "username already exists.";
            header("location: ../view/CreateUserview.php");
        }
    }
}
?>
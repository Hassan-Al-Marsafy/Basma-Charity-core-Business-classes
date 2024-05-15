<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id == $_POST["id"];
    require_once '../model/CRUDmodel.php';
    require_once '../model/db_connect.php';
    require_once '../strategy/CRUDuser.php';

    $User = new CRUDmodel();
    $User->setOperation(new CRUDuser($user_name, $user_type, $name, $pdo));

    if ($User->deleteOperation($id)) {
        header("location: ../index.php");
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

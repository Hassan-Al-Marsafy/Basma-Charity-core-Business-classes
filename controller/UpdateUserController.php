<?php

$name = $user_name = $user_type = "";
$name_err = $user_name_err = $user_type_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
  $id = $_POST["id"];
  $input_name = trim($_POST["name"]);
  if (empty($input_name)) {
    $name_err = "Please enter a name.";
  } else {
    $name = $input_name;
  }

  $input_user_name = trim($_POST["user_name"]);
  if (empty($input_user_name)) {
    $user_name_err = "Please enter a user_name.";
  } else {
    $user_name = $input_user_name;
  }

  $input_user_type = trim($_POST["user_type"]);
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
    $User->setOperation(new CRUDuser($user_name, $user_type, $name));

    if ($User->updateUser($id, $user_name, $user_type, $name)) {
      header("location: ../view/ChooseUserCRUD.php");
    } else {
      echo "Something Went Wrong";
    }
  }
} else {
  if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    require_once '../model/CRUDmodel.php';
    require_once '../model/db_connect.php';
    require_once '../strategy/CRUDuser.php';

    $User = new CRUDmodel();
    $User->setOperation(new CRUDuser($user_name, $user_type, $name));
    $usr = $User->readOperation($id);

    if (!empty($usr)) {
      $name = $usr["name"];
      $user_name = $usr["user_name"];
      $type = $usr["user_type"];
    } else {
      echo "Something went wrong.Please try again later.";
    }

  }
}
?>
<?php
$name = $user_name = $user_type = "";
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
  $id = trim($_GET["id"]);

  require_once '../model/CRUDmodel.php';
  require_once '../model/db_connect.php';
  require_once '../strategy/CRUDuser.php';

  $User = new CRUDmodel();
  $User->setOperation(new CRUDuser($user_name, $user_type, $name));
  $result = $User->readAllUserDonations($id);
  if (!empty($result)) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>date</th>";
    echo "<th>user id</th>";
    echo "<th>accountant id</th>";
    echo "<th>manager id</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($result as $don) {
      echo "<tr>";
      echo "<td>" . $don['id'] . "</td>";
      echo "<td>" . $don['date'] . "</td>";
      echo "<td>" . $don['user_id'] . "</td>";
      echo "<td>" . $don['accountant_id'] . "</td>";
      echo "<td>" . $don['manager_id'] . "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

  } else {
    echo "<p class='lead'><em>No Donations were found for this user.</em></p>";
  }
} else {
  header("location: error.php");
  exit();
}
?>
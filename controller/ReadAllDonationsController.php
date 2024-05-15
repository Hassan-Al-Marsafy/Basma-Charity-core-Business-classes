<?php
//require_once 'Model/ReadClass.php';
$date = $user_id = $accountant_id =$manager_id = "";
require_once '../model/CRUDmodel.php';
require_once '../model/db_connect.php';
require_once '../strategy/CRUDdonation.php';
//  function readOperation($id) {
//  $this->operation->read($id);
//$Donation->setOperation(new CRUDdonation($date, $user_id, $accountant_id, $manager_id, $pdo));
//if($Donation->insertOperation()){

$Donation = new CRUDmodel();  
$Donation->setOperation(new CRUDdonation($date, $user_id, $accountant_id, $manager_id, $pdo));
$result= $Donation->readAllDonations();

//$read = new ReadClass();
//$result = $read->readAll();

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>date</th>";
    echo "<th>user id</th>";
    echo "<th>accountant id</th>";
    echo "<th>manager id</th>";
    echo "<th></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['accountant_id'] . "</td>";
        echo "<td>" . $row['manager_id'] . "</td>";
        echo "<td>";
        echo "<a href='view/read.php?id=" . $row['id'] . "' title='View Task' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
        echo "<a href='View/update.php?id=" . $row['id'] . "' title='Update Task' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
        echo "<a href='View/delete.php?id=" . $row['id'] . "' title='Delete Task' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "<p class='lead'><em>No Tasks were found.</em></p>";
}
?>
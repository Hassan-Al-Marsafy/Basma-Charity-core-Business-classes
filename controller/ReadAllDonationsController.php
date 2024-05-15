<?php

$date = $user_id = $accountant_id =$manager_id = "";
require_once '../model/CRUDmodel.php';
require_once '../model/db_connect.php';
require_once '../strategy/CRUDdonation.php';

$Donation = new CRUDmodel();  
$Donation->setOperation(new CRUDdonation($date, $user_id, $accountant_id, $manager_id));
$result= $Donation->readAllDonations();

if (!empty($result)) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>date</th>";
    echo "<th>user id</th>";
    echo "<th>accountant id</th>";
    echo "<th>manager id</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($result as $don) {
        echo "<tr>";
        echo "<td>" . $don['id'] . "</td>";
        echo "<td>" . $don['date'] . "</td>";
        echo "<td>" . $don['user_id'] . "</td>";
        echo "<td>" . $don['accountant_id'] . "</td>";
        echo "<td>" . $don['manager_id'] . "</td>";
        echo "<td>";
        echo "<a href='UpdateDonationView.php?id=" . $don['id'] . "' title='Update Donation' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
        echo "<a href='DeleteDonationView.php?id=" . $don['id'] . "' title='Delete Donation' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "<p class='lead'><em>No Tasks were found.</em></p>";
}
?>
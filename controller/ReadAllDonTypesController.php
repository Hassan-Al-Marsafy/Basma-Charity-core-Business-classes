<?php

$id = $type = "";
require_once '../model/CRUDmodel.php';
require_once '../model/db_connect.php';
require_once '../strategy/CRUDdonType.php';

$DonType = new CRUDmodel();  
$DonType->setOperation(new CRUDdonType($type));
$result = $DonType->readAllDonTypes();

if (!empty($result)) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>type</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($result as $donType) {
        echo "<tr>";
        echo "<td>" . $donType['id'] . "</td>";
        echo "<td>" . $donType['D_type_name'] . "</td>";
        echo "<td>";
        echo "<a href='UpdateDonTypenView.php?id=" . $donType['id'] . "' title='Update DonType' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
        echo "<a href='DeleteDonTypeView.php?id=" . $donType['id'] . "' title='Delete DonType' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "<p class='lead'><em>No Tasks were found.</em></p>";
}
?>
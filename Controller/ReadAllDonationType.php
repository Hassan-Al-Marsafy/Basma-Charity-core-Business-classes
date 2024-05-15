<?php
require_once '../model/db_connect.php'; 
require_once '../strategy/CRUDdonType.php';
require_once '../model/donationType.php';

try {

    $crudDonType = new CRUDdonType('', $pdo);
    

    $donationTypes = $crudDonType->readAllDonTypes();


    if ($donationTypes) {

        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Type</th></tr>";
        foreach ($donationTypes as $donationType) {
            echo "<tr>";
            echo "<td>" . $donationType['id'] . "</td>";
            echo "<td>" . $donationType['D_type_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No donation types found.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

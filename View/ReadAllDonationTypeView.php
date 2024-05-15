<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Donation Types</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>All Donation Types</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require_once '../model/db_connect.php'; 
            

            $query = "SELECT id, D_type_name FROM donation_types";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $donationTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

            if ($donationTypes) {
  
                foreach ($donationTypes as $donationType) {
                    echo "<tr>";
                    echo "<td>" . $donationType['id'] . "</td>";
                    echo "<td>" . $donationType['D_type_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                
                echo "<tr><td colspan='2'>No donation types found</td></tr>";
            }
            ?>
            
            
        </tbody>
    </table>
</div>

</body>
</html>

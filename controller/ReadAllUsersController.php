<?php

$user_name = $type = $name= "";
require_once '../model/CRUDmodel.php';
require_once '../model/db_connect.php';
require_once '../strategy/CRUDuser.php';

$User = new CRUDmodel();  
$User->setOperation(new CRUDuser($user_name , $type, $name));
$result= $User->readUsers();

if (!empty($result)) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Type</th>";
    echo "<th>Name</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($result as $usr) {
        echo "<tr>";
        echo "<td>" . $usr['id'] . "</td>";
        echo "<td>" . $usr['user_name'] . "</td>";
        echo "<td>" . $usr['user_type'] . "</td>";
        echo "<td>" . $usr['name'] . "</td>";
        echo "<td>";
        echo "<a href='ViewUserController?id=" . $usr['id'] . "' title='View Task' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
        echo "<a href='../view/UpdateUserView.php?id=" . $usr['id'] . "' title='Update Task' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
        echo "<a href='../view/DeleteUserView.php?id=" . $usr['id'] . "' title='Delete Task' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "<p class='lead'><em>No Tasks were found.</em></p>";
}
?>
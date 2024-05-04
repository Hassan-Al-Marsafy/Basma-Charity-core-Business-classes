<?php
    interface CRUDinterface{
        function insert();
        function read($id);
        function delete($id);
        //function update($id , $newInfo_1 , $newInfo_2 , $newInfo_3 , $managerId);
}
echo"Interface Working";
echo "</br>";
echo "</br>";
?>
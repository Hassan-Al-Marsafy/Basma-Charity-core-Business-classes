<?php
    interface CRUDinterface{
        function insert();
        function read($id);
        function delete($id);
    }
?>
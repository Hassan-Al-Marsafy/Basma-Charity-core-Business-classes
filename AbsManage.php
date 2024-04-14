<?php
include 'IManage.php';

abstract class AbsManage implements IManage {
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
}
?>

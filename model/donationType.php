<?php
require_once ("CRUDinterface.php");

class DonationType extends AbstractID{
    private $type;
    private $pdo;
    private $donType;

    function __construct($type, $pdo) {
        $this->type = $type;
        $this->pdo = $pdo;
    }

    // Getters and Setters
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getDonType(){
        return $this->donType;
    }

    public function setDonType($donType){
        $this->donType = $donType;
        return $this;
    }

    function insertDonType() {
        $this->donType->insert();
    }

    function updateDonType($id, $newType) {
        $sql = "UPDATE donation_types SET D_type_name=? WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        return $stmt->execute([$newType, $id]);
    }

    function readDonType($id) {
        $this->donType->read($id);
    }

    function deleteDonType($id) {
        $this->donType->delete($id);
    }
}


?>
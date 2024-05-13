<?php
require_once ("db_connect.php");
require_once ("C:\\xampp\htdocs\\BasmaGit\\Basma-Charity-core-Business-classes\\strategy\\CRUDdonType.php");
class DonationType {
    private $donType;

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
        $this->donType->update($id,$newType);

    }

    function readDonType($id) {
        return $this->donType->read($id);
    }

    function deleteDonType($id) {
        $this->donType->delete($id);
    }
}


$test=new DonationType();
$test->setDonType(new CRUDdonType("goods",$pdo));
$testing=$test->readDonType(13);

echo $testing


?>
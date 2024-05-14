<?php
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
        return $this->donType->insert();
    }

    function updateDonType($id, $newType) {
        $this->donType->update($id,$newType);

    }

    function readDonType($id) {
        $this->donType->read($id);
    }

    function deleteDonType($id) {
        $this->donType->delete($id);
    }
}


?>
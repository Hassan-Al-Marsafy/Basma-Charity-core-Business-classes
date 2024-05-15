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
        return $this->donType->update($id, $newType);

    }

    function readDonType($id) {
<<<<<<< Updated upstream
        $row = $this->donType->read($id);
        return $row;
=======
        return $this->donType->read($id);
>>>>>>> Stashed changes
    }

    function deleteDonType($id) {
        $this->donType->delete($id);
    }
}


?>
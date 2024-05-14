<?php
class DonationDetails {
    private $donDetail;
    public function getDonDetail(){
        return $this->donDetail;
    }

    public function setDonDetail($donDetail){
        $this->donDetail = $donDetail;
        return $this;
    }
    // Database manipulation functions
    function insertDonDetail() {
        return $this->donDetail->insert();
    }

    function update($id, $newDonationId, $newDonationTypeId, $newQuantity) {
       return $this->donDetail->update($id, $newDonationId, $newDonationTypeId, $newQuantity);
    }

    function read($id) {
        $this->donDetail->read($id);
    }

    function delete($id) {
        $this->donDetail->delete($id);

    }
}
?>

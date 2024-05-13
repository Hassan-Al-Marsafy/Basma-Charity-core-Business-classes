<?php
class Donation {
    private $don;
    public function getDonation(){
        return $this->don;
    }

    public function setDonation($don){
        $this->don = $don;
        return $this;
    }
    // Database manipulation functions
    function addDonationDetail($donationDetailId, $donationTypeId, $quantity) {
        $this->don->addDetail();

    }

    function insertDonation() {
        $this->don->insert();

    }

    function updateDonation($id, $newDate, $newUserId, $newAccountantId, $newManagerId) {
        $this->don->update($id, $newDate, $newUserId, $newAccountantId, $newManagerId);

    }

    function readDonation($id) {
        $this->don->read($id);
    }

    function readAllDonationDetails() {
        $this->don->readAllDetails();

    }

    function deleteDonation($id) {
        $this->don->delete($id);

    }
}
?>

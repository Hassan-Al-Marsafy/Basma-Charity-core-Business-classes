<?php
require_once 'CRUDinterface.php';
require_once 'AbstractID.php';
require_once 'donationDetails.php';

class Donation extends AbstractID{
    private $don;
    private $donationDetails = array(); // Array to hold DonationDetails objects

    public function getDonType(){
        return $this->don;
    }

    public function setDonType($don){
        $this->don = $don;
        return $this;
    }
    public function getDonationDetails() {
        return $this->donationDetails;
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

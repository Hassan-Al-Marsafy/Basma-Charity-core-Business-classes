<?php
require_once ("db_connect.php");
require_once ("C:\\xampp\htdocs\\BasmaGit\\Basma-Charity-core-Business-classes\\strategy\\CRUDdonDetails.php");
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
    function insert() {
        $this->donDetail->insert();
    }

    function update($id, $newDonationId, $newDonationTypeId, $newQuantity) {
        $this->donDetail->update($id, $newDonationId, $newDonationTypeId, $newQuantity);
    }

    function read($id) {
        $this->donDetail->read($id);
    }

    function delete($id) {
        $this->donDetail->delete($id);

    }
}
?>

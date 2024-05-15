<?php
class DonDetailsObserver extends Observer{
    public function __construct($CRUDdonDetails) {
        $this->D=$CRUDdonDetails;
        $this->D->attach($this);
    }
    public function update() {
        $DonDetail = $this->D->getOperation();
        if ($DonDetail instanceof CRUDdonDetails) {
            $_SESSION['message'] = 'Donation Deatil made. Donation Id: ' . $DonDetail->getDonationId() . ', Donation Type ID: ' . $DonDetail->getDonationTypeId() . ', Quantity: ' . $DonDetail->getQuantity();
        }
    }
    
    
}


?>
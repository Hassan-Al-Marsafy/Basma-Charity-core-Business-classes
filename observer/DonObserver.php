<?php
class DonObserver extends Observer{
    public function __construct($CRUDdonation) {
        $this->D=$CRUDdonation;
        $this->D->attach($this);
    }
    public function update() {
        $donation = $this->D->getOperation();
        if ($donation instanceof CRUDdonation) {
            $_SESSION['message'] = 'Donation made. Date: ' . $donation->getDate() . ', User ID: ' . $donation->getUserId() . ', Accountant ID: ' . $donation->getAccountantId() . ', Manager ID: ' . $donation->getManagerId();
        }
    }
    
    
}


?>
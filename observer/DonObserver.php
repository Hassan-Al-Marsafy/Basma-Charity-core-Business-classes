<?php
class DonObserver extends Observer{
    public function __construct($CRUDdonation) {
        $this->D=$CRUDdonation;
        $this->D->attach($this);
    }
    public function update() {
        $donation = $this->D->getOperation();
        if ($donation instanceof CRUDdonation) {
            echo 'Donation made ';
            echo "date: {$donation->getDate()}, user id: {$donation->getUserId()}, accountant id: {$donation->getAccountantId()}, manager id: {$donation->getManagerId()}<br>";
            echo "<hr>";
        }
    }
    
}


?>
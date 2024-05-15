<?php
class DonTypeObserver extends Observer{
    public function __construct($CRUDdonType) {
        $this->D=$CRUDdonType;
        $this->D->attach($this);
    }
    public function update() {
        $type = $this->D->getOperation();
        if ($type instanceof CRUDdonType) {
            $_SESSION['message'] = 'Donation Type Created. Type: ' . $type->getType();
        }
    }
    
    
}

?>
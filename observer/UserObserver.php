<?php
class UserObserver extends Observer{
    public function __construct($CRUDUser) {
        $this->D=$CRUDUser;
        $this->D->attach($this);
    }
    public function update() {
        $user = $this->D->getOperation();
        if ($user instanceof CRUDuser) {
            $_SESSION['message'] = 'User Created. User Name: ' . $user->getUserName() . ', Name: ' . $user->getName();
        }
    }
    
    
}

?>
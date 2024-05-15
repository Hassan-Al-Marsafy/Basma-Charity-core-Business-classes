<?php
class PasswordDecorator extends CRUDUserDecorator {
    private $password;

    public function __construct(CRUDinterface $crudUser, $password) {
        parent::__construct($crudUser);
        $this->password = $password;
    }

    public function insert() {
        $userId = parent::insert();
        if ($this->crudUser instanceof CRUDuser) {
            $sql = "INSERT INTO login_info (id, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE password = ?";
            $stmt = $this->crudUser->getPdo()->prepare($sql);
            $stmt->execute([$userId, $this->password, $this->password]);
        }
        return $userId;
    }
    
    
    
    
}

?>
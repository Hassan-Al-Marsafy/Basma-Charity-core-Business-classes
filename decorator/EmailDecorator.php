<?php
require_once ("CRUDuserDecorator.php");
require_once ("CRUDuserDecorator.php");
class EmailDecorator extends CRUDUserDecorator {
    private $email;

    public function __construct(CRUDinterface $crudUser, $email) {
        parent::__construct($crudUser);
        $this->email = $email;
    }

    public function insert() {
        $userId = parent::insert();
        if ($this->crudUser instanceof CRUDuser) {
            $sql = "INSERT INTO login_info (id, email) VALUES (?, ?) ON DUPLICATE KEY UPDATE email = ?";
            $stmt = $this->crudUser->getPdo()->prepare($sql);
            $stmt->execute([$userId, $this->email, $this->email]);
        }
        return $userId;
    }
    
}

?>
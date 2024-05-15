<?php
require_once ("../strategy/CRUDinterface.php");
class CRUDUserDecorator implements CRUDinterface {
    protected $crudUser;

    public function __construct(CRUDinterface $crudUser) {
        $this->crudUser = $crudUser;
    }

    public function insert() {
        return $this->crudUser->insert();
    }

    public function read($id) {
        return $this->crudUser->read($id);
    }

    public function delete($id) {
        return $this->crudUser->delete($id);
    }
}


?>
<?php
abstract class AbstractID {
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
?>

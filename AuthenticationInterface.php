<?php
interface AuthenticationInterface {
    public function signIn($userId, $password);
    public function signOut();
}
?>
<?php
include_once __DIR__ . '/../model/User.php';

class UserController {
    private $user;
    function __construct()
    {
        $this->user = new User();
    }

    public function getUsers()
    {
        return $this->user->getUsers();
    }

    public function getUser($id)
    {
        return $this->user->getUser($id);
    }

    public function getTotalUsers(){
        return $this->user->getTotalUsers();
    }
}

?>
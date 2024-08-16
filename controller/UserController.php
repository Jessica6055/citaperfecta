<?php
include_once 'model/User.php';

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login($username, $password) {
        if ($this->user->authenticate($username, $password)) {
            session_start();
            $_SESSION['loggedin'] = true;
            header("Location: index.php?action=home");
        } else {
            header("Location: index.php?action=login&error=1");
        }
    }

    public function register($username, $password) {
        if ($this->user->createUser($username, $password)) {
            header("Location: index.php?action=login");
        } else {
            header("Location: index.php?action=register&error=1");
        }
    }
}
?>

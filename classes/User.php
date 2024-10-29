<?php
class User {
    private $users;

    public function __construct() {
        $this->users = json_decode(file_get_contents('data/users.json'), true);
    }

    public function authenticate($username, $password) {
        foreach ($this->users as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }
}
?>

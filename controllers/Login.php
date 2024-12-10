<?php

require 'config/bd.php';


class Login
{
    protected $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function login(array $data): bool
    {
        $sql = "SELECT password FROM users WHERE email = :email";
        $stm = $this->db->prepare($sql);
        $stm->execute([
            ':email' => $data['email']
        ]);

        if ($row = $stm->fetch(PDO::FETCH_OBJ)) {
            $password = $row->password;

            if (password_verify($data['password'], $password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

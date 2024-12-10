<?php

require 'config/bd.php';
require 'models/User.php';

class Users
{
    protected $db;

    public function __construct()
    {
        $this->db = new DBConnection();
    }

    public function getRows($search = ''): int
    {
        $search = $search != '' ? '%' . $search . '%' : '%%';
        $sql = "SELECT COUNT(id) AS 'rows' FROM users WHERE name LIKE :search1 OR lastname LIKE :search2 OR email LIKE :search3";
        $stm = $this->db->prepare($sql);
        $stm->execute([
            ':search1' => $search,
            ':search2' => $search,
            ':search3' => $search
        ]);
        $rows = $stm->fetch(PDO::FETCH_OBJ)->rows;

        return $rows;
    }

    public function getUsers($page, $search = ''): array
    {
        $users = array();
        $start = ($page * 10) - 10;
        $search = $search != '' ? '%' . $search . '%' : '%%';
        $sql = "SELECT id,name,lastname,email FROM users WHERE name LIKE :search1 OR lastname LIKE :search2 OR email LIKE :search3 LIMIT " . $start . ",10";
        $stm = $this->db->prepare($sql);
        $stm->execute([
            ':search1' => $search,
            ':search2' => $search,
            ':search3' => $search
        ]);
        while ($row = $stm->fetch(PDO::FETCH_OBJ)) {
            $User = new User();
            $User->id = $row->id;
            $User->name = $row->name;
            $User->lastname = $row->lastname;
            $User->email = $row->email;
            $users[] = $User;
        }

        return $users;
    }

    public function getUser($id): Object
    {
        $User = new User();
        $sql = 'SELECT * FROM users WHERE id=:id';
        $stm = $this->db->prepare($sql);
        $stm->execute([':id' => $id]);
        while ($row = $stm->fetch(PDO::FETCH_OBJ)) {
            $User->id = $row->id;
            $User->name = $row->name;
            $User->lastname = $row->lastname;
            $User->email = $row->email;
        }

        return $User;
    }

    public function saveUser($User): bool
    {
        if ($User->id == 0) {
            $sql = 'INSERT INTO users (name,lastname,email,password) VALUES(:name,:lastname,:email,:password)';
            $stm = $this->db->prepare($sql);
            $result = $stm->execute([
                ':name' => $User->name,
                ':lastname' => $User->lastname,
                ':email' => $User->email,
                ':password' => password_hash($User->password, PASSWORD_DEFAULT)
            ]);
        } else {
            if ($User->password != '') {
                $sql = 'UPDATE users SET name=:name,lastname=:lastname,email=:email,password=:password WHERE id=:id';
                $stm = $this->db->prepare($sql);
                $result = $stm->execute([
                    ':id' => $User->id,
                    ':name' => $User->name,
                    ':lastname' => $User->lastname,
                    ':email' => $User->email,
                    ':password' => password_hash($User->password, PASSWORD_DEFAULT)
                ]);
            } else {
                $sql = 'UPDATE users SET name=:name,lastname=:lastname,email=:email WHERE id=:id';
                $stm = $this->db->prepare($sql);
                $result = $stm->execute([
                    ':id' => $User->id,
                    ':name' => $User->name,
                    ':lastname' => $User->lastname,
                    ':email' => $User->email
                ]);
            }
        }

        return $result ? true : false;
    }

    public function deleteUser($id): bool
    {
        $sql = 'DELETE FROM users WHERE id=:id';
        $stm = $this->db->prepare($sql);
        $result = $stm->execute([
            ':id' => $id
        ]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

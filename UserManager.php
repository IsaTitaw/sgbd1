<?php
include 'ItemManager.php';
include 'VerifyManager.php';

class UserManager extends ItemManager
{
    function __construct() {
        parent::__construct('users');
    }

    function create($data) {
        return new User(
            $data['pk'],
            $data['username'],
            $data['password']

        );
    }

    function save($data) {
        $pk = -1;

        if (!VerifyManager::sanitizeData($data)) {
            return false;
        }

        $user = $this->create([
            'pk' => $pk,
            'username' => $data['username'],
            'password' => $data['password'],
        ]);

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, password) VALUES (?, ?)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),

                ]);
                return true;
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        return false;
    }



    function update($data) {
        if (!VerifyManager::sanitizeData($data)) {
            return false;
        }

        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['username'],
            'password' => $data['password']
        ]);

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "UPDATE {$this->table} SET username = ?, password = ? WHERE pk = ?"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),
                    $user->__get('pk'),
                ]);
                return true;
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        return false;
    }

}



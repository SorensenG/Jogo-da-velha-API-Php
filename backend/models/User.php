<?php
require_once __DIR__ . '/../config/database.php';

class User
{

    public function registerUser($registerData)
    {

        global $pdo;

        $createUserSQL = "INSERT INTO users (nome, nascimento, cpf, telefone, email, username, senha)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($createUserSQL);
        $success =  $stmt->execute([
            $registerData['fullname'],     
            $registerData['birthdate'],
            $registerData['cpf'],
            $registerData['phone'],
            $registerData['email'],
            $registerData['username'],
            password_hash($registerData['password'], PASSWORD_BCRYPT)
        ]);
         if ($success) {
            $id = $pdo->lastInsertId();
            return [
                'id' => $id,
                'username' => $registerData['username']
            ];
        }

        return false;
    }
    

   public function findUserByUsername($username)
{
    global $pdo;

    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    return $stmt->fetch(PDO::FETCH_ASSOC); // só 1 usuário
}

    public function findUserById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserInfos($id, $updateData)
    {
        global $pdo;

        $fields = [];
        $params = [];

        if (!empty($updateData['fullname'])) {
            $fields[] = 'nome = ?';
            $params[] = $updateData['fullname'];
        }

        if (isset($updateData['phone'])) {
            $fields[] = 'telefone = ?';
            $params[] = $updateData['phone'];
        }

        if (!empty($updateData['email'])) {
            $fields[] = 'email = ?';
            $params[] = $updateData['email'];
        }

        if (!empty($updateData['password'])) {
            $fields[] = 'senha = ?';
            $params[] = password_hash($updateData['password'], PASSWORD_BCRYPT);
        }

        if (count($fields) === 0) {
            // Nothing to update
            return false;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $params[] = $id;

        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }
}



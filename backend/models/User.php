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

    public function updateUserInfos($id, $updateData)
    {
        global $pdo;

        $updateUserSql = "UPDATE users SET userName=?, phone=?, email=?, userPassword=? WHERE id=?";

        $stmt = $pdo->prepare($updateUserSql);

        return $stmt->execute([
            $updateData['userName'],
            $updateData['phone'],
            $updateData['email'],
            $updateData['email'],
            password_hash($updateData, PASSWORD_BCRYPT),
            $id
        ]);
    }
}



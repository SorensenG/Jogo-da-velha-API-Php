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
        return $stmt->execute([
            $registerData['nome'],
            $registerData['nascimento'],
            $registerData['cpf'],
            $registerData['telefone'],
            $registerData['email'],
            $registerData['username'],
            password_hash($registerData['senha'], PASSWORD_BCRYPT)
        ]);
    }

    public function findUserByUsername($username)
    {
        global $pdo;

        $findUserSql = "SELECT * FROM users WHERE username = ? LIMIT 1"; // limita a 1 para otimizar a consulta
        $stmt = $pdo->prepare($findUserSql);
        $stmt->execute([$username]);
        //provavelmente teremos que retornar os dados do user, porem até o memomento nao precisamos

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

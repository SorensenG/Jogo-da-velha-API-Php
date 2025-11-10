<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'jogo_memoria';

try {
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria o banco
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8 COLLATE utf8_general_ci;");
    $pdo->exec("USE $dbName;");

    // Tabela de usuários
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            nascimento DATE NOT NULL,
            cpf VARCHAR(14) NOT NULL UNIQUE,
            telefone VARCHAR(20),
            email VARCHAR(100) NOT NULL,
            username VARCHAR(50) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL
        );
    ");

    // Tabela de partidas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS partidas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            dimensao VARCHAR(10) NOT NULL,
            modalidade ENUM('Classica','Contra o Tempo') NOT NULL,
            tempo_gasto FLOAT NOT NULL,
            jogadas INT NOT NULL,
            resultado ENUM('Vitoria','Derrota') NOT NULL,
            data_partida DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ");

    echo "Banco de dados e tabelas criados com sucesso!";

} catch (PDOException $e) {
    echo "Erro ao criar banco: " . $e->getMessage();
}

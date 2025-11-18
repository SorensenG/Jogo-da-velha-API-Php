<?php
/**
 * Seeder script to populate the database with sample users and partidas.
 * Usage: from project root run `php backend/utils/seed_db.php`
 *
 * This script uses the existing PDO connection from `config/database.php`.
 * Passwords are hashed with password_hash(..., PASSWORD_BCRYPT).
 * All sample personal data is fictional and intended for testing only.
 */

require_once __DIR__ . '/../config/database.php';

try {
    $pdo->beginTransaction();

    $users = [
        [
            'nome' => 'Ana Souza',
            'nascimento' => '1990-05-12',
            'cpf' => '111.222.333-44',
            'telefone' => '(11) 91234-5678',
            'email' => 'ana.souza@example.com',
            'username' => 'anasouza',
            'password' => 'Passw0rd!'
        ],
        [
            'nome' => 'Bruno Martins',
            'nascimento' => '1985-11-03',
            'cpf' => '222.333.444-55',
            'telefone' => '(21) 99876-5432',
            'email' => 'bruno.martins@example.com',
            'username' => 'brunom',
            'password' => 'Senha123!'
        ],
        [
            'nome' => 'Carla Ferreira',
            'nascimento' => '1997-07-21',
            'cpf' => '333.444.555-66',
            'telefone' => '(31) 99111-2222',
            'email' => 'carla.ferreira@example.com',
            'username' => 'carlaf',
            'password' => 'Jogo2025!'
        ],
        [
            'nome' => 'Diego Lima',
            'nascimento' => '2000-02-18',
            'cpf' => '444.555.666-77',
            'telefone' => '(41) 98888-7777',
            'email' => 'diego.lima@example.com',
            'username' => 'diegol',
            'password' => 'Memoria#01'
        ],
        [
            'nome' => 'Elisa Rocha',
            'nascimento' => '1993-09-09',
            'cpf' => '555.666.777-88',
            'telefone' => '(51) 97777-6666',
            'email' => 'elisa.rocha@example.com',
            'username' => 'elisar',
            'password' => 'Teste!234'
        ]
    ];

    $insertUserStmt = $pdo->prepare(
        "INSERT INTO users (nome, nascimento, cpf, telefone, email, username, senha) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $insertPartidaStmt = $pdo->prepare(
        "INSERT INTO partidas (user_id, dimensao, modalidade, tempo_gasto, jogadas, resultado, data_partida) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $createdUsers = [];

    foreach ($users as $u) {
        $hashed = password_hash($u['password'], PASSWORD_BCRYPT);
        $insertUserStmt->execute([
            $u['nome'],
            $u['nascimento'],
            $u['cpf'],
            $u['telefone'],
            $u['email'],
            $u['username'],
            $hashed
        ]);

        $userId = $pdo->lastInsertId();
        $createdUsers[] = [
            'id' => $userId,
            'username' => $u['username'],
            'password' => $u['password']
        ];

        // Add some partidas for this user (3 per user)
        $samplePartidas = [
            ['3x3', 'Classica', 12.5, 10, 'Vitoria', date('Y-m-d H:i:s', strtotime('-2 days'))],
            ['4x4', 'Contra o Tempo', 45.3, 30, 'Derrota', date('Y-m-d H:i:s', strtotime('-1 days'))],
            ['5x5', 'Classica', 78.9, 55, 'Vitoria', date('Y-m-d H:i:s', strtotime('-6 hours'))]
        ];

        foreach ($samplePartidas as $p) {
            $insertPartidaStmt->execute([
                $userId,
                $p[0],
                $p[1],
                $p[2],
                $p[3],
                $p[4],
                $p[5]
            ]);
        }
    }

    $pdo->commit();

    echo "Seeding completed. Created users:\n";
    foreach ($createdUsers as $c) {
        echo "- ID: {$c['id']}  username: {$c['username']}  password: {$c['password']}\n";
    }

    echo "\nInserted sample partidas for each user.\n";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Error while seeding: " . $e->getMessage() . "\n";
}

?>

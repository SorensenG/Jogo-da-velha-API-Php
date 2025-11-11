<?php
require_once __DIR__ . '/../config/database.php';

class GameMatch
{

    public function saveGame($matchData)
    {

        global $pdo;

        $saveGameSQL = "INSERT INTO partidas (user_id, dimensao, modalidade, tempo_gasto, jogadas, resultado)
                VALUES (?, ?, ?, ?, ?, ?)";


        $stmt = $pdo->prepare($saveGameSQL);

        return $stmt->execute([
            $matchData['user_id'],
            $matchData['dimensao'],
            $matchData['modalidade'],
            $matchData['tempo_gasto'],
            $matchData['jogadas'],
            $matchData['resultado']
        ]);
    }

    public function searchUserMatchs($userId)
    {

        global $pdo;

        $searchUserSQL = "SELECT * FROM partidas where user_id = ? ORDER BY data_parida DESC";

        $stmt = $pdo->prepare($searchUserSQL);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function topPlayers()
    {

        global $pdo;

        $topMatchSQL = "SELECT u.username, p.*
                FROM partidas p
                JOIN users u ON u.id = p.user_id
                WHERE p.resultado = 'Vitoria'
                ORDER BY p.dimensao DESC, p.jogadas ASC, p.tempo_gasto ASC
                LIMIT 10";

        $stmt = $pdo->query($topMatchSQL);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

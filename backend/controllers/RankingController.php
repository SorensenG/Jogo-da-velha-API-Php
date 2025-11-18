<?php
require_once __DIR__ . '/../models/GameMatch.php';

class RankingController
{

    public function getTopPlayers()
    {
        try {
            $match = new GameMatch();
            $topPlayers = $match->topPlayers();

            return [
                'status' => 200,
                'message' => 'top 10 players ranked sucessefully',
                'data' => $topPlayers
            ];

        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }
}

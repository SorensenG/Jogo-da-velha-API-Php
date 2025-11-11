<?php
require_once __DIR__ . '/../models/GameMatch.php';

class RankingController
{

    public function getTopPlayers()
    {

        $match = new GameMatch();

        $topPlayers = $match->topPlayers();

        if ($topPlayers && count($topPlayers) > 0) {

            return [
                'status' => '200 ok',
                'message' => 'top 10 players ranked sucessefully',
                'data' => $topPlayers
            ];
        } else {
            return [
                'status' => '404 not faund',
                'message' => 'Sem jogadores no ranking'
            ];
        }
    }
}

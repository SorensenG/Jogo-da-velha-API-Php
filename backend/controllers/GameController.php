<?php
require_once __DIR__ . '/../models/GameMatch.php';

class GameMatchController
{
    public function getUserMatchs($userId)
    {
        $match = new GameMatch();

        try {
            $userMatchsData = $match->searchUserMatchs($userId);

            if ($userMatchsData === false | count($userMatchsData) === 0) {
                throw new Exception('Erro ao pegar dados de partida');
            }
            return [
                'status' => '200 ok',
                'message' => 'top 10 players ranked sucessefully',
                'data' => $userMatchsData
            ];

        } catch (Exception $e) {
            return [
                'status' => '500',
                'message' => 'Erro interno do servidor',
            ];
        }
    }
    public function saveGame($matchData)
    {
        $match = new GameMatch();

        try {
            $match->saveGame($matchData);
        } catch (Exception $e) {
            return [
                'status' => '500',
                'message' => 'Erro interno do servidor'
            ];
        }
    }
}


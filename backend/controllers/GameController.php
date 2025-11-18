<?php
require_once __DIR__ . '/../models/GameMatch.php';

class GameMatchController
{
    public function getUserMatchs($userId)
    {
        $match = new GameMatch();

        try {
            $userMatchsData = $match->searchUserMatchs($userId);

            // Se ocorrer erro na consulta
            if ($userMatchsData === false) {
                throw new Exception('Erro ao buscar partidas do usuário');
            }

            // ⚠️ IMPORTANTE:
            // Se o usuário não tiver partidas, isso NÃO é erro → retornamos lista vazia.
            return [
                'status' => 200,
                'message' => 'Partidas encontradas com sucesso',
                'data' => $userMatchsData   // pode ser []
            ];

        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }


    public function saveGame($matchData, $userId)
    {
        $match = new GameMatch();

        // adiciona user_id ao array
        $matchData['user_id'] = $userId;

        try {
            $success = $match->saveGame($matchData);

            if (!$success) {
                throw new Exception('Erro ao salvar a partida');
            }

            return [
                'status' => 201,
                'message' => 'Partida salva com sucesso'
            ];

        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }
}

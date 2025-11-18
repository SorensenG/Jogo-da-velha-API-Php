export default async function saveGame(dimensao, modalidade, tempo_gasto, jogadas, resultado) {
    try {
        console.log("TENTANDO CONECTAR COM O PHP")
        const response = await fetch("../backend/routes/game/save.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ dimensao, modalidade, tempo_gasto, jogadas, resultado }),
        });
        
        console.log("RETORNO: " + await response.text())

        if (response.ok) {
            console.log("Jogo salvo com sucesso!")
        } else {
            console.log("Erro ao salvar partida: " + response['message'])
        }
    } catch (error) {
        console.error("Erro ao salvar partida:", error);
        alert(`Erro ao salvar partida: ${error.message || error}`);
    }
}


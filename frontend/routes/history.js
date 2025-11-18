document.addEventListener("DOMContentLoaded", async () => {

    try {
        const response = await fetch("../backend/routes/game/history.php", {
            method: "GET",
            headers: { "Content-Type": "application/json" },
        });

        const data = await response.json();
        console.log("RESPONSE RAW:", data);

        // valida estrutura
        if (!data || !data.data) {
            alert("Erro ao carregar histórico.");
            return;
        }

        const gamesArray = data.data;

        // nenhum jogo encontrado
        if (gamesArray.length === 0) {
            console.log("Nenhuma partida encontrada.");
            return;
        }

        const tableBody = document.getElementById("sessionHistorybody");

        gamesArray.forEach((jogo) => {
            const linha = document.createElement('tr');

            const dimensao = document.createElement('th');
            const modo = document.createElement('th');
            const jogadas = document.createElement('th');
            const tempo = document.createElement('th');
            const resultado = document.createElement('th');

            dimensao.textContent = jogo.dimensao;
            modo.textContent = jogo.modalidade;
            jogadas.textContent = jogo.jogadas;
            tempo.textContent = jogo.tempo_gasto;
            resultado.textContent = jogo.resultado;

            linha.appendChild(dimensao);
            linha.appendChild(modo);
            linha.appendChild(jogadas);
            linha.appendChild(tempo);
            linha.appendChild(resultado);

            tableBody.appendChild(linha);
        });

    } catch (error) {
        console.error("Erro ao pegar histórico:", error);
        alert(`Erro ao pegar histórico: ${error.message || error}`);
    }
});

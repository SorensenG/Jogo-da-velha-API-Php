document.addEventListener("DOMContentLoaded", async (e) => {

    try {
        const response = await fetch("../backend/routes/game/history.php", {
            method: "GET",
            headers: { "Content-Type": "application/json" },
        });

        const data = await response.json();
        console.log("DATA: " + Object.values(data.data[0]))
        const gamesArray = Object.values(data.data)

        const tableBody = document.getElementById("sessionHistorybody")
        gamesArray.map((jogo) => {
            const linha = document.createElement('tr')

            const dimensao = document.createElement('th')
            const modo = document.createElement('th')
            const jogadas = document.createElement('th')
            const tempo = document.createElement('th')
            const resultado = document.createElement('th')

            dimensao.textContent = jogo.dimensao
            modo.textContent = jogo.modalidade
            jogadas.textContent = jogo.jogadas
            tempo.textContent = jogo.tempo_gasto
            resultado.textContent = jogo.resultado

            linha.appendChild(dimensao)
            linha.appendChild(modo)
            linha.appendChild(jogadas)
            linha.appendChild(tempo)
            linha.appendChild(resultado)

            tableBody.appendChild(linha)
        })

    } catch (error) {
        console.error("Erro ao pegar histórico:", error);
        alert(`Erro ao pegar histórico: ${error.message || error}`);
    }
});

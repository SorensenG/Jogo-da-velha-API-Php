document.addEventListener("DOMContentLoaded", async (e) => {

    try {
        const response = await fetch("../backend/routes/ranking/list.php", {
            method: "GET",
            headers: { "Content-Type": "application/json" },
        });

        const data = await response.json();
        const gamesArray = Object.values(data.data)

        const tableBody = document.getElementById("rankingTableBody")
        gamesArray.map((jogo, index) => {
            const linha = document.createElement('tr')

            const posicao = document.createElement('td')
            const username = document.createElement('td')
            const dimensoes = document.createElement('td')
            const jogadas = document.createElement('td')
            const tempo = document.createElement('td')
            const data = document.createElement('td')

            posicao.textContent = index + 1
            username.textContent = jogo.username
            dimensoes.textContent = jogo.dimensao
            jogadas.textContent = jogo.jogadas
            tempo.textContent = jogo.tempo_gasto
            data.textContent = jogo.data_partida

            linha.appendChild(posicao)
            linha.appendChild(username)
            linha.appendChild(dimensoes)
            linha.appendChild(jogadas)
            linha.appendChild(tempo)
            linha.appendChild(data)

            tableBody.appendChild(linha)
        })

    } catch (error) {
        console.error("Erro ao pegar ranking:", error);
        alert(`Erro ao pegar ranking: ${error.message || error}`);
    }
});

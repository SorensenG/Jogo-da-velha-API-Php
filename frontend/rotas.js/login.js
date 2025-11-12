document.getElementById("login-form").addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    try {
        const response = await fetch("../backend/routes/auth/login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();

       if (response.ok && data.status === 200) {
      window.location.href = "jogo.html";
        } else {
            alert(data.message || "Usuário ou senha incorretos.");
        }
    } catch (error) {
        console.error("Erro ao fazer login:", error);
        alert(`Erro ao fazer login: ${error.message || error}`);
    }
});

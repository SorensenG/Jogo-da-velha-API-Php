document.addEventListener("DOMContentLoaded", () => {
  const logoutLink = document.getElementById("logoutLink");

  if (logoutLink) {
    logoutLink.addEventListener("click", async (e) => {
      e.preventDefault(); 

      try {
        const response = await fetch("../backend/routes/auth/logout.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
        });

        const data = await response.json();

        if (response.ok && data.status === 200) {
          alert("Sessão encerrada com sucesso!");
          window.location.href = "index.html"; 
        } else {
          alert(`Erro ao desconectar: ${data.message || "tente novamente"}`);
        }
      } catch (error) {
        console.error("Erro no logout:", error);
        alert(`Erro ao encerrar sessão: ${error.message || error}`);
      }
    });
  }
});

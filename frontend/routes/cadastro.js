document.getElementById("register-form").addEventListener("submit", async (e) => {
  e.preventDefault();

  const userData = {
    fullname: document.getElementById("fullname").value,
    birthdate: document.getElementById("birthdate").value,
    cpf: document.getElementById("cpf").value,
    phone: document.getElementById("phone").value,
    email: document.getElementById("email").value,
    username: document.getElementById("username").value,
    password: document.getElementById("password").value,
  };

  try {
    const response = await fetch("../backend/routes/auth/register.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(userData),
    });

    const data = await response.json();

    if (response.ok && data.status === 201) {
      window.location.href = "jogo.html";
    } else {
      alert(`Erro: ${data.message || "Falha ao cadastrar usuário."}`);
    }
  } catch (error) {
    console.error("Erro ao cadastrar:", error);
    alert(`Erro: ${error.message || error}`);
  }
});

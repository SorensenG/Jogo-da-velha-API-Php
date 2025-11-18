document.addEventListener('DOMContentLoaded', async () => {
    const form = document.getElementById('profile-form');
    const fullnameEl = document.getElementById('fullname');
    const phoneEl = document.getElementById('phone');
    const emailEl = document.getElementById('email');
    const passwordEl = document.getElementById('password');
    const usernameEl = document.getElementById('username');
    const birthdateEl = document.getElementById('birthdate');
    const cpfEl = document.getElementById('cpf');

    // Load current profile
    try {
        const res = await fetch('../backend/routes/auth/profile.php', {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'include'
        });

        const data = await res.json();

        if (res.ok && data.status === 200 && data.user) {
            const u = data.user;
            usernameEl.value = u.username || '';
            birthdateEl.value = u.nascimento || '';
            cpfEl.value = u.cpf || '';
            fullnameEl.value = u.nome || '';
            phoneEl.value = u.telefone || '';
            emailEl.value = u.email || '';
        } else if (data.status === 401) {
            alert('Você precisa estar logado para editar o perfil.');
            window.location.href = 'index.html';
        } else {
            console.error('Profile fetch error', data);
        }
    } catch (err) {
        console.error('Erro ao carregar perfil:', err);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const payload = {
            fullname: fullnameEl.value.trim(),
            phone: phoneEl.value.trim(),
            email: emailEl.value.trim()
        };

        if (passwordEl.value && passwordEl.value.length > 0) {
            payload.password = passwordEl.value;
        }

        try {
            const res = await fetch('../backend/routes/auth/update.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'include',
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (res.ok && data.status === 200) {
                alert('Perfil atualizado com sucesso.');
                // Clear password field
                passwordEl.value = '';
            } else if (data.status === 401) {
                alert('Sessão expirada. Faça login novamente.');
                window.location.href = 'index.html';
            } else {
                alert(data.message || 'Falha ao atualizar perfil.');
            }
        } catch (err) {
            console.error('Erro ao atualizar perfil:', err);
            alert('Erro ao atualizar perfil. Veja o console para detalhes.');
        }
    });
});

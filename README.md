🎮 WebGaming - Jogo da Memória & Jogo da Velha

API completa em PHP + MySQL para jogos multiplayer com sistema de autenticação, perfil de usuário, histórico de partidas e ranking global.


📋 Índice

Sobre o Projeto
Tecnologias
Estrutura do Projeto
Instalação
Rotas da API
Usuários de Teste
Segurança
Melhorias Futuras
Contribuindo


🎯 Sobre o Projeto
O WebGaming é uma plataforma web que oferece jogos clássicos (Jogo da Memória e Jogo da Velha) com sistema completo de gerenciamento de usuários. O projeto segue a arquitetura MVC e fornece uma API RESTful para integração com o frontend.
✨ Funcionalidades

✅ Sistema de autenticação com sessões PHP
✅ Cadastro e gerenciamento de perfil de usuário
✅ Registro automático de partidas
✅ Histórico de jogos pessoal
✅ Ranking global de jogadores
✅ Interface responsiva e moderna


🛠 Tecnologias
TecnologiaVersãoUsoPHP7.4+Backend e APIMySQL5.7+Banco de dadosApache2.4+Servidor webHTML5/CSS3/JS-FrontendPDO-Conexão com banco
📦 Requisitos

XAMPP (ou LAMP/WAMP)
PHP com extensões: pdo, pdo_mysql, password
MySQL ou MariaDB


📁 Estrutura do Projeto
WEBGAMING/
│
├── 🎨 frontend/                      # Interface do usuário
│   ├── index.html                    # Tela de login
│   ├── cadastro.html                 # Registro de novo usuário
│   ├── jogo.html                     # Tabuleiro do jogo
│   ├── perfil.html                   # Edição de perfil
│   ├── ranking.html                  # Ranking global
│   ├── config.html                   # Configurações de jogo
│   ├── css/
│   │   └── index.css                 # Estilos globais
│   └── js/
│       └── jogo.js                   # Lógica do jogo
│
├── ⚙️ backend/                       # API e lógica de negócio
│   ├── config/
│   │   └── database.php              # Conexão PDO
│   │
│   ├── models/                       # Camada de dados
│   │   ├── User.php                  # Modelo de usuário
│   │   └── Match.php                 # Modelo de partida
│   │
│   ├── controllers/                  # Lógica de controle
│   │   ├── AuthController.php        # Autenticação
│   │   ├── GameController.php        # Gerenciamento de jogos
│   │   └── RankingController.php     # Sistema de ranking
│   │
│   ├── routes/                       # Endpoints da API
│   │   ├── auth/
│   │   │   ├── login.php             # POST - Login
│   │   │   ├── register.php          # POST - Cadastro
│   │   │   ├── logout.php            # GET/POST - Logout
│   │   │   ├── profile.php           # GET - Dados do perfil
│   │   │   └── update.php            # POST - Atualizar perfil
│   │   │
│   │   ├── game/
│   │   │   ├── save.php              # POST - Salvar partida
│   │   │   └── history.php           # GET - Histórico
│   │   │
│   │   └── ranking/
│   │       └── list.php              # GET - Ranking global
│   │
│   └── utils/
│       ├── session.php               # Gerenciamento de sessão
│       ├── db_init.php               # Inicialização do banco
│       └── seed_db.php               # Dados de teste
│
└── README.md

🚀 Instalação
1️⃣ Clonar ou baixar o projeto
Coloque o projeto na pasta do servidor:
bashC:\xampp\htdocs\Jogo-da-velha-API-Php
2️⃣ Iniciar serviços
Abra o XAMPP Control Panel e inicie:

✅ Apache
✅ MySQL

3️⃣ Criar banco de dados
Acesse no navegador ou execute via terminal:
Opção 1 - Navegador:
http://localhost/Jogo-da-velha-API-Php/backend/utils/db_init.php
Opção 2 - Terminal:
powershellcd C:\xampp\htdocs\Jogo-da-velha-API-Php
php backend/utils/db_init.php
4️⃣ Popular com dados de teste (opcional)
powershellphp backend/utils/seed_db.php

⚠️ Este comando cria 5 usuários de exemplo e 15 partidas (3 por usuário).

5️⃣ Acessar o sistema
Abra no navegador:
http://localhost/Jogo-da-velha-API-Php/frontend/index.html

🌐 Rotas da API
🔐 Autenticação
MétodoRotaDescriçãoAutenticaçãoPOST/backend/routes/auth/register.phpCadastrar usuário❌ NãoPOST/backend/routes/auth/login.phpFazer login❌ NãoGET/POST/backend/routes/auth/logout.phpEncerrar sessão✅ SimGET/backend/routes/auth/profile.phpObter perfil✅ SimPOST/backend/routes/auth/update.phpAtualizar perfil✅ Sim
🎮 Jogo
MétodoRotaDescriçãoAutenticaçãoPOST/backend/routes/game/save.phpSalvar partida✅ SimGET/backend/routes/game/history.phpHistórico de partidas✅ Sim
🏆 Ranking
MétodoRotaDescriçãoAutenticaçãoGET/backend/routes/ranking/list.phpListar ranking global❌ Não

📝 Exemplos de Requisição
Login
jsonPOST /backend/routes/auth/login.php
Content-Type: application/json

{
  "username": "anasouza",
  "password": "Passw0rd!"
}
Atualizar Perfil
jsonPOST /backend/routes/auth/update.php
Content-Type: application/json

{
  "fullname": "Ana Paula Souza",
  "phone": "(11) 98765-4321",
  "email": "ana.souza@example.com",
  "password": "NovaSenha123!"
}

👥 Usuários de Teste
UsernameSenhaEmailanasouzaPassw0rd!ana.souza@example.combrunomSenha123!bruno.martins@example.comcarlafJogo2025!carla.ferreira@example.comdiegolMemoria#01diego.lima@example.comelisarTeste!234elisa.rocha@example.com

🔒 Nota: Todas as senhas são armazenadas com hash seguro (password_hash).


🔒 Segurança
⚠️ Avisos Importantes

🔴 Este projeto usa sessões PHP para autenticação
🔴 Não há proteção CSRF implementada
🔴 Validações de entrada são básicas
🔴 Não use em produção sem as devidas melhorias

✅ Recomendações para Produção

Implementar HTTPS obrigatório
Usar tokens JWT em vez de sessões
Adicionar rate limiting nas rotas de login
Validar e sanitizar todas as entradas
Implementar CORS adequadamente
Remover scripts de seeding do servidor
Adicionar logs de auditoria
Implementar proteção contra CSRF


🚧 Melhorias Futuras
Backend

 Validação completa de dados (email, CPF, telefone)
 Confirmação de senha atual antes de alterações
 Sistema de recuperação de senha
 Paginação no histórico e ranking
 DTOs para respostas padronizadas
 Testes automatizados (PHPUnit)
 Documentação Swagger/OpenAPI

Frontend

 Feedback visual em vez de alert()
 Loading states durante requisições
 Validação de formulários em tempo real
 PWA (Progressive Web App)
 Modo escuro
 Internacionalização (i18n)

Features

 Chat entre jogadores
 Partidas em tempo real (WebSocket)
 Sistema de conquistas
 Avatares customizáveis
 Estatísticas detalhadas


🤝 Contribuindo
Contribuições são bem-vindas! Para contribuir:

Faça um fork do projeto
Crie uma branch para sua feature (git checkout -b feature/NovaFeature)
Commit suas mudanças (git commit -m 'Adiciona nova feature')
Push para a branch (git push origin feature/NovaFeature)
Abra um Pull Request

📏 Padrões de Código

Use PSR-12 para código PHP
Mantenha consistência com o código existente
Adicione comentários em lógicas complexas
Escreva mensagens de commit descritivas


📄 Licença
Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

📞 Contato

📧 Email: seu-email@example.com
💼 LinkedIn: Seu Nome
🐙 GitHub: @seu-usuario


<div align="center">
Desenvolvido com 💙 por [Seu Nome]
⭐ Se este projeto te ajudou, considere dar uma estrela!
</div>

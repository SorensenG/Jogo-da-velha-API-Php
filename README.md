WEBGAMING/
│
├── frontend/                         # 🎨 VIEW → parte visível
│   ├── index.html                    # tela de login
│   ├── cadastro.html                 # tela de cadastro
│   ├── jogo.html                     # tabuleiro e lógica JS
│   ├── perfil.html                   # edição de usuário
│   ├── ranking.html                  # ranking global
│   ├── config.html                   # escolha de dimensões/modalidade
│   ├── css/
│   │   └── index.css
│   └── js/
│       └── jogo.js
│
├── backend/                          # ⚙️ MODEL + CONTROLLER → PHP + BD
│   ├── config/
│   │   └── database.php              # conexão PDO com MySQL
│   ├── models/                       # MODEL → estrutura dos dados
│   │   ├── User.php
│   │   └── Match.php
│   ├── controllers/                  # CONTROLLER → lógica do sistema
│   │   ├── AuthController.php        # login / registro
│   │   ├── GameController.php        # salvar partidas
│   │   └── RankingController.php     # ranking
│   ├── routes/                       # ROTAS (arquivos chamados pelo fetch)
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   ├── register.php
│   │   │   └── logout.php
│   │   ├── game/
│   │   │   ├── save.php
│   │   │   └── history.php
│   │   └── ranking/
│   │       └── list.php
│   └── utils/
│       └── session.php               # checagem de login ativo
│
└── README.md

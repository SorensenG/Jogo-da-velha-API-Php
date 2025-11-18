**Project**
- **Name**: Jogo da Velha / Jogo da Memória — PHP backend + static frontend
- **Purpose**: Small web game with user registration/login, match history and a simple ranking system.

**Repository Structure**
- **`frontend/`**: static HTML/CSS/JS for the UI
	- `index.html` — login
	- `cadastro.html` — register
	- `jogo.html` — game UI and logic
	- `perfil.html` — profile editor
	- `ranking.html` — ranking view
	- `routes/` — small frontend JS modules (login, cadastro, saveGame, perfil etc.)
- **`backend/`**: PHP API and DB helpers
	- `config/database.php` — PDO connection to MySQL
	- `models/` — data access (`User.php`, `GameMatch.php`)
	- `controllers/` — request handling (`AuthController.php`, `GameController.php`, `RankingController.php`)
	- `routes/` — public endpoints called by frontend (e.g. `backend/routes/auth/login.php`)
	- `utils/` — helpers (`session.php`, `db_init.php`, `seed_db.php`)

**Requirements**
- PHP 7.4+ (with PDO + MySQL driver)
- MySQL or MariaDB
- A web server (Apache via XAMPP recommended on Windows)

**Quick setup (XAMPP on Windows)**
- Place repository in `C:\xampp\htdocs\Jogo-da-velha-API-Php`.
- Start Apache and MySQL from XAMPP Control Panel.

**Initialize database and tables**
- The project includes `backend/utils/db_init.php` which creates the database and tables when executed.
- Run from project root (PowerShell):
```powershell
php backend/utils/db_init.php
```

**Seed sample data**
- There is a seeder at `backend/utils/seed_db.php` which inserts example users and partidas (passwords are hashed).
- Run (PowerShell):
```powershell
php backend/utils/seed_db.php
```
The script prints created usernames and their test plaintext passwords for convenience.

**API Routes (examples)**
- `backend/routes/auth/register.php` — POST JSON to register a user.
- `backend/routes/auth/login.php` — POST JSON { username, password } to log in.
- `backend/routes/auth/logout.php` — GET/POST to log out.
- `backend/routes/auth/profile.php` — GET returns current logged-in user's profile (requires session cookie).
- `backend/routes/auth/update.php` — POST JSON to update profile for logged-in user.
- `backend/routes/game/save.php` — POST to save a partida/match.
- `backend/routes/game/history.php` — GET user match history.
- `backend/routes/ranking/list.php` — GET global ranking data.

**Frontend usage**
- Open in browser after login: `http://localhost/Jogo-da-velha-API-Php/frontend/index.html`.
- The frontend uses `fetch()` to call the backend `routes/*.php` endpoints and relies on PHP session cookies for authentication.

**Security & Notes**
- Passwords are hashed using `password_hash(..., PASSWORD_BCRYPT)` in the PHP code.
- `cpf` and `username` fields are marked `UNIQUE` in the DB; seeding may fail if duplicates exist.
- For production, do not serve files directly from a dev XAMPP root without proper protections; sanitize and validate all inputs.

**Development tips**
- To inspect DB content use phpMyAdmin (bundled with XAMPP) or the MySQL CLI.
- To add validation or new fields, start by updating `backend/models/User.php` and `backend/controllers/AuthController.php`, then the corresponding frontend JS.

**Next steps / Optional improvements**
- Add server-side validation for email format and password strength.
- Add uniqueness checks on update (email/CPF).
- Add CSRF protection and require current password when changing to a new password.

**Contact / Ownership**
- Maintainer: repository owner (local project)

Enjoy developing and testing!


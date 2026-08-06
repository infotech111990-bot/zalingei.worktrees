Zalingei University website

This Laravel project is a university website ready for local XAMPP testing and cPanel deployment.

Local setup
-----------
1. Copy `.env.example` to `.env`.
2. Run `composer install`.
3. Run `php artisan key:generate`.
4. Set `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`.
5. Run `php artisan migrate`.
6. Run `php artisan db:seed --class=DatabaseSeeder` if you want seed data.

Local URLs
----------
- If your XAMPP document root points directly to `public/`, use: `http://localhost/`
- Admin login: `http://localhost/mtCPanel/login`
- If the project is served from a subfolder, use `http://localhost/<folder>/public/`.
- Or run `php artisan serve --host=127.0.0.1 --port=8001` and open `http://127.0.0.1:8001/`.

Database
--------
- A full database dump is available at `database/database.sql` for import into phpMyAdmin.

cPanel deployment
-----------------
- Place the project outside `public_html` if possible, then point the site document root to the project's `public/` directory.
- If the host cannot change the document root, copy `public/` contents into `public_html` and update `index.php` paths to the Laravel project folder.
- Create `.env` from `.env.production.example`.
- Set `APP_DEBUG=false` in production.
- Import `database/database.sql` into the new database.

Notes
-----
- Do not commit `.env` or other sensitive configuration files.
- If the database is not available yet, `php artisan config:cache` and `php artisan view:cache` can help verify deployment readiness.

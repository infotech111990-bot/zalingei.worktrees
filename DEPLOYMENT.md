# cPanel deployment

## Prerequisites

- PHP 8.2–8.5 with `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `fileinfo`, and `curl` enabled.
- A MySQL or MariaDB database and user.
- Apache `mod_rewrite` enabled.

## Deploy

1. Upload this Laravel project outside `public_html`, for example to `/home/ACCOUNT/zalingei`.
2. Point the domain document root to `/home/ACCOUNT/zalingei/public`. If the host cannot change the document root, copy only the contents of `public/` to `public_html` and update its `index.php` paths to the directory that contains the Laravel project.
3. Create `.env` from `.env.production.example`. Set the production URL, database values, mail values, `APP_DEBUG=false`, and a unique `APP_KEY` generated with `php artisan key:generate --force`.
4. Ensure `storage/` and `bootstrap/cache/` are writable by the web-server user (normally 775 on cPanel, depending on the host configuration).
5. Run `composer install --no-dev --optimize-autoloader`, then run:

   ```sh
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. In cPanel, create the database and database user, grant that user all privileges, then select the new database in phpMyAdmin and import `database/database.sql`. The import file intentionally does not create or select a database, so it works with cPanel's account-prefixed database names.

## Important release notes

- Do not upload `.env`, `keys.txt`, `test.php`, `storage/logs`, or development artifacts to the public web root.
- The missing Association, Managers, Council, Events, and Search source controllers were not present in the provided archive. Their URLs intentionally return HTTP 503 until their original source is restored.
- The provided SQL contains the current `zalingei` application database (18 tables and 8 data inserts). The separate `zalingei_main` database in the original backup was not bundled because this Laravel application is configured to use `zalingei`.
- The `blog/` directory is a separate WordPress installation. Deploy and maintain it independently, including its database and WordPress updates.

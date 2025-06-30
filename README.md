📚 ebooks_24u
Malá ukázková webová aplikace v PHP 8.3, která zobrazuje katalog e-knih a umožňuje jejich správu přes jednoduché administrační rozhraní.
Backend stojí na Doctrine ORM + Migrations (Postresql), frontend využívá SASS a čistý ES6 JavaScript, kompilované pomocí Gulp.

Požadavky
PHP
≥ 8.3 rozšíření pdo_pgsql, intl, mbstring
Composer
≥ 2.5
správce PHP balíčků
Node.js / npm
≥ 20 / ≥ 10
build frontendu
Gulp CLI
npm i -g gulp
volitelné globální, jinak npx gulp
Postgresql
≥ 17
nebo jiný DB driver podporovaný Doctrine
Apache
s mod_rewrite
viz nastavení VirtualHostu níže

2. Klonování repozitáře
git clone https://github.com/uzivatel/ebooks_24u.git
cd ebooks_24u

3. Konfigurace Apache
/etc/apache2/sites-available/ebooks_24u.conf 👇
<VirtualHost *:80>
    ServerAdmin lukyn.ma@gmail.com
    ServerName ebooks_24u.local
    ServerAlias www.ebooks_24u.local
    DocumentRoot /var/www/ebooks_24u/public

    <Directory /var/www/ebooks_24u/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        DirectoryIndex index.php
    </Directory>

    ErrorLog  ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
sudo a2ensite ebooks_24u.conf
sudo a2enmod rewrite
echo "127.0.0.1  ebooks_24u.local" | sudo tee -a /etc/hosts
sudo systemctl reload apache2
Aplikace poběží na http://ebooks_24u.local.

4. Backend – instalace závislostí
composer install            # nainstaluje Doctrine ORM, Migrations, ...
Autoload je nastaven na public/entities, takže entity třídy tamtéž.

5. Frontend – instalace & build
npm ci                      # stáhne Gulp + pluginy (viz package.json)
npx gulp                    # přeloží SASS → CSS a zkopíruje/minifikuje assety
# nebo během vývoje:
npx gulp watch
V případě potřeby můžete Gulp CLI nainstalovat globálně:
npm i -g gulp

6. Databáze & Doctrine Migrations
Používáme PostgreSQL. Pro jinou DB stačí změnit DSN v konfigu.
    1. Vytvořte databázi (pokud ještě neexistuje)
    • vendor/bin/doctrine orm:database:create        # volitelné, SQLite soubor vznikne sám
    2. Spusťte migrace
    • vendor/bin/doctrine-migrations migrate
        ◦ Pokud je DB prázdná, Doctrine vytvoří tabulky dle migrací.
        ◦ Po každé změně entity vygenerujte novou migraci:
        ◦ vendor/bin/doctrine-migrations diff    # vytvoří novou verzi v migrations/
    vendor/bin/doctrine-migrations migrate # aplikuje ji
        ◦ Rychlá kontrola, co by se provedlo, bez změn:
        ◦ vendor/bin/doctrine-migrations migrate --dry-run

8. Užitečné příkazy
Úloha
Příkaz
Update schématu bez migrací (dev)
vendor/bin/doctrine orm:schema-tool:update --force

Build frontendu jen jednou
npx gulp build
Sleduj změny SASS/JS
npx gulp watch

Hotovo! Otevřete prohlížeč na http://ebooks_24u.local a měl by se zobrazit katalog knih. 🎉
# Mouse Breeding Database (mousedb)

A lab colony-management web application: mice, strains, breeding cages,
litters, weaning, cage transfers, comments, tags, saved searches, printable
wean cards, and role-based users.

Built on Zend Framework 1 (MVC, Zend_Db, Zend_Form, Zend_Dojo, Zend_Pdf)
with a Dojo 1.5 front end and a MySQL/MariaDB database.

## Requirements

- PHP 8.1 or newer (tested on 8.3) with the `pdo_mysql`, `mbstring`, `gd`
  and `openssl` extensions.
- MySQL 5.7+ or MariaDB 10.2+.
- Apache with `mod_rewrite` (see `public_html/.htaccess`), or any server
  that routes unknown paths to `public_html/index.php`.

Zend Framework is bundled in `library/Zend` as the
[zf1-future](https://github.com/Shardj/zf1-future) fork (release 1.25.2),
which keeps ZF1 working on current PHP. No Composer step is needed.

## Installation

1. Create a database and load `documents/sql/create_database.sql`, then
   `documents/sql/create_demo_users.sql` for an initial admin login.
2. Copy `application/config/config.ini.example` to
   `application/config/config.ini` and fill in the `db.params.*` values and
   a writable `system.logfile` path.
3. Point the web server document root at `public_html/`.

`config.ini` holds credentials and is ignored by git.

## Running locally

```
php -S localhost:8080 -t public_html public_html/router.php
```

`router.php` mimics the `.htaccess` rewrite for PHP's built-in server.

## Notes on the PHP 8 upgrade

The application was originally hosted on PHP 5. The port to PHP 8 consisted
of swapping the bundled ZF 1.11 for zf1-future and a small set of
application fixes (see the git history for details):

- `eregi()` replaced with `preg_match()`.
- Validators no longer create dynamic properties; use `setId()` /
  `setWhere()` on `mdb_Validate_UniqueValue`.
- Strict SQL mode is relaxed per connection in `mdb_Initializer::initDb()`,
  because the forms store empty strings in integer and date columns.
- Dojo is loaded from Google's CDN over https by default; override with
  `system.dojo.cdn.*` or `system.dojo.local` in `config.ini`.

## License and attribution

This application is derived from **LAMA** (Laboratory Animal Management
Assistant) by Marko Milisavljevic, published at
<https://launchpad.net/mousedb> under the GNU General Public License
version 3. This repository carries that code forward with local
modifications and the PHP 8 port described above, and is distributed under
the same license. See the `LICENSE` file for the full text.

Bundled third-party components keep their own licenses:

- `library/Zend`: zf1-future, New BSD License.
- `library/mdb/Validate/Date.php`: Travello GmbH, New BSD License.
- `public_html/styles/blueprint`: Blueprint CSS, MIT-style license.
- `public_html/scripts/sorttable.js`: Stuart Langridge, MIT license.

## Known follow-ups

- Passwords are stored as unsalted MD5 (`users.password`). Moving to
  `password_hash()` with rehash-on-login is recommended.
- Tables use the MyISAM engine. Converting to InnoDB is safe and gives
  transactions and crash recovery.
- Dojo 1.5 is end of life. It still works and is still served by the CDN,
  but any front-end rework should plan to replace it.

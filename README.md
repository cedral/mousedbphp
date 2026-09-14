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
- Passwords set through the admin user forms are hashed with
  `password_hash()`. Rows still holding the original unsalted MD5 digest
  keep working and are upgraded the next time that user's password is set.
  Existing installs must run `documents/sql/upgrade_password_hash.sql` once
  to widen the column.
- Strict SQL mode is relaxed per connection in `mdb_Initializer::initDb()`,
  because the forms store empty strings in integer and date columns.
- Tables are InnoDB. Existing installs can convert with
  `documents/sql/upgrade_innodb.sql`.
- The search pages need FULLTEXT indexes that the original schema never
  defined. Existing installs must run
  `documents/sql/upgrade_fulltext_indexes.sql` once or every search fails
  with MySQL error 1191.
- Dojo 1.13.0, the last 1.x release, is loaded from Google's CDN over https
  by default; override with `system.dojo.cdn.*` or `system.dojo.local` in
  `config.ini`. Two adjustments were needed for Dojo 1.7+: the `yyMMdd`
  date fields use strict parsing (the lenient parser read 260115 as year
  2601), and all forms carry `novalidate` because Dojo now leaves Zend's
  `required="false"` on the native inputs, which the browser treats as
  required.

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

- None outstanding. The legacy `dojo.require()` loader style still works
  in Dojo 1.13 but is deprecated; a future front-end rework should move to
  AMD modules or a different toolkit.

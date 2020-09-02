# wiki

Very personal wiki

## Prerequisite

1. Docker
2. Docker Compose

## Installation

1. [Download](https://github.com/2JS/wiki/archive/master.zip) or clone this repository.
2. Run `sudo ./bootstrap.sh` in termial.
3. Set up `.env`, `.config` file. Details below.
4. Run `docker-compose up -d` in terminal.
5. Open http://localhost/mw-config on web brower and follow the instructions.

**CAUTION:** Do not overwrite `LocalSettings.php` as given in the last instruction. Do it if you understand what are you doing. This step initializes database.

6. Run `docker-compose exec wiki php maintenance/update.php --quick`
7. [Voila!](http://localhost/wiki)

### Set up `.env`, `.config` file

This file sets system environment variable of running containers. Write a plain text file named `.env` inside `compose` directory.

#### `.env`

```
HOST=localhost
EMAIL=me@mail.com
```

| Variable (Required*) | Example     | Description                                           |
| -------------------- | ----------- | ----------------------------------------------------- |
| HOST*                | localhost   | Domain name that hosts mediawiki. Or IP address.      |
| EMAIL*               | me@mail.com | An email address for issuing letsencrypt certificate. |

#### `.config`

```
MYSQL_USER=user
MYSQL_PASSWORD=P@55W0RD
WG_PATH=/wiki
WG_SCRIPTPATH=/w
WG_SITENAME=
WG_METANAMESPACE=Project
WG_LANGUAGECODE=en
WG_EMERGENCYCONTACT=me@mail.com
WG_PASSWORDSENDER=me@mail.com
WG_SECRETKEY=
WG_UPGRADEKEY=4yy8yq1d4v1sxdpz
WG_SMTP_HOST=ssl://smtp.mail.com
WG_SMTP_IDHOST=mail.com
WG_SMTP_LOCALHOST=this.wiki
WG_SMTP_PORT=465
WG_SMTP_USERNAME=me@mail.com
WG_SMTP_PASSWORD=P@55W0RD
WG_SMTP_AUTH=true
```

| Variable (Required*) | Example              | Description                                                  |
| -------------------- | -------------------- | ------------------------------------------------------------ |
| MYSQL_USER*          | wiki                 | User of mariadb database.                                    |
| MYSQL_PASSWORD*      | P@55W0RD             | **Do not leak**. Password of corresponding user              |
| WG_PATH*             | /wiki                | URI path for wiki articles.                                  |
| WG_SCRIPTPATH*       | /w                   | URI path for wiki resources(scripts, images, etc).           |
| WG_SITENAME*         | Wikipedia            | Name of wiki.                                                |
| WG_METANAMESPACE*    | Project              | Name for project namespace                                   |
| WG_LANGUAGECODE*     | en                   | Language code for wiki                                       |
| WG_EMERGENCYCONTACT* | abcd@efg.com         | Emergency email address. Also used for letsencrypt certificate issuing. |
| WG_PASSWORDSENDER    | abcd@efg.com         | Adress that may send email reset, security alers, etc.       |
| WG_SECRETKEY*        | *(64 length string)* | **Do not leak**. Random 64-character alphanumeric string. You can generate one with `keygen.py`. Refer [Manual:$wgSecretKey](https://www.mediawiki.org/wiki/Manual:$wgSecretKey). |
| WG_UPGRADEKEY*       | 1omwk5pxsphkk6cl     | **Do not leak**. Random 16-character alphanumeric string. You can generate one with `keygen.py`. Refer [Manual:$wgUpgradeKey](https://www.mediawiki.org/wiki/Manual:$wgUpgradeKey) |
| WG_SMTP_HOST         |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_IDHOST       |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_LOCALHOST    |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PORT         | 465                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_USERNAME     |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PASSWORD     |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_AUTH         | 1 or empty           | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |

#### `keygen.py`

You need these unique keys to run secure wiki. Type `python keygen.py` or shortly `./keygen.py` to generate one.

```bash
> ./keygen.py # either python 2 or 3 is fine.
$wgSecretKey=   8nghg15hmibsqqzzdqpeue9on9k5ezumyis6d1rrfmx8lpjsj3xchohwhx5gb4jo
$wgUpgradeKey=  1omwk5pxsphkk6cl
```

### Configure `traefik.yml`

Almost everything is already set up. You only need to configure `entrypoints.websecure.http.tls.domains.main` and `certificatesResolvers.letsencrypt.acme.email`.

The first value is domain name, and the second one is email address. Replace `2js.dev` and `lego3410@gmail.com` with your ones.

#### "I don't need HTTPS"

These values are used to get letsencrypt certificate, which is necessary for HTTPS secure connection. For those of you who don't want HTTPS or have no domain, just leave them blank, and delete lines containing

* `traefik.http.routers.wiki-local.`
* `traefik.http.routers.wiki-global.`
* `traefik.http.routers.wiki.tls.`
* `traefik.http.middlewares.redirector.`

in `docker-compose.yml`.

## Usage

### Start

```bash
docker-compose up -d --build
```

### Stop

```bash
docker-compose down
```

**CAUTION**: Do not use option `-v` or `--volumes` when stopping services. It will irreversibly delete wiki data(including files and articles, users, etc) entirely.

## Backup and Restore

To backup, run backup script. It'll archive database contents and uploaded files into `backups` directory.

```bash
./backup.sh
```

Restore script is not ready yet.

Refer to [Manual:Backing up a wiki](https://mediawiki.org/wiki/Manual:Backing_up_a_wiki) for more detail.
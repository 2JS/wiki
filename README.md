# wiki

Very personal wiki

## Prerequisite

1. Docker
2. Docker Compose

## Installation

1. [Download](https://github.com/2JS/wiki/archive/master.zip) or clone this repository
2. Set up .env file.
3. Configure traefik.yml.
4. Open the repository with terminal
5. Create empty `compose/traefik/acme.json` file.
6. Run `docker-compose up -d`
7. Open http://localhost/mw-config on web brower and follow the instructions.

**CAUTION:** Do not overwrite `LocalSettings.php` as given in the last instruction. Do it if you understand what are you doing. This step initializes database.

6. Run `docker-compose exec wiki php maintenance/update.php --quick`
7. [Voila!](http://localhost/wiki)

### Set up .env file

This file sets system environment variable of running containers. Write a plain text file named `.env` inside `compose` directory.

```
BIND_URL=http://localhost
MYSQL_USER=user
MYSQL_PASSWORD=P@55W0RD
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
| BIND_URL*            | http://localhost     | URL that hosts mediawiki                                     |
| MYSQL_USER*          | wiki                 | User of mariadb database.                                    |
| MYSQL_PASSWORD*      | P@55W0RD             | Password of corresponding user                               |
| WG_EMERGENCYCONTACT* | abcd@efg.com         | Emergency email address. Also used for letsencrypt certificate issuing. |
| WG_PASSWORDSENDER    | abcd@efg.com         | Adress that may send email reset, security alers, etc.       |
| WG_SECRETKEY         | *(64 length string)* | Random 64-character string. Refer [Manual:$wgSecretKey](https://www.mediawiki.org/wiki/Manual:$wgSecretKey) |
| WG_UPGRADEKEY        | 4yy8yq1d4v1sxdpz     | Random 16-character string. Refer [Manual:$wgUpgradeKey](https://www.mediawiki.org/wiki/Manual:$wgUpgradeKey) |
| WG_SMTP_HOST         |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_IDHOST       |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_LOCALHOST    |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PORT         |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_USERNAME     |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PASSWORD     |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_AUTH         |                      | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |

**CAUTION:** Be careful not to leak WG_SECRETKEY and WG_UPGRADEKEY value.

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


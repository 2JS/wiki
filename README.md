# wiki

Very personal wiki

## Usage

### Installation

1. [Download](https://github.com/2JS/wiki/archive/master.zip) or clone this repository
2. [Set up .env file](#Set up .env file).
3. Open the repository with terminal
4. Run `docker-compose up -d`
5. Open http://localhost/mw-config on web brower and follow the instructions

**CAUTION:** Do not overwrite `LocalSettings.php` as given in the last instruction. Do it if you understand what are you doing.

#### Set up .env file

This file sets system environment variable of running containers. Write a plain text file named `.env` inside `compose` directory.

| Variable (Required*) | Example          | Description                                                  |
| -------------------- | ---------------- | ------------------------------------------------------------ |
| BIND_URL*            | http://localhost | URL that hosts mediawiki                                     |
| MYSQL_USER*          | wiki             | User of mariadb database.                                    |
| MYSQL_PASSWORD*      | P@55W0RD         | Password of corresponding user                               |
| WG_EMERGENCYCONTACT  | abcd@efg.com     | Emergency email address                                      |
| WG_PASSWORDSENDER    | abcd@efg.com     | Adress that may send email reset, security alers, etc.       |
| WG_SMTP_HOST         |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_IDHOST       |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_LOCALHOST    |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PORT         |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_USERNAME     |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_PASSWORD     |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |
| WG_SMTP_AUTH         |                  | Refer [Manual:$wgSMTP](https://www.mediawiki.org/wiki/Manual:$wgSMTP) |


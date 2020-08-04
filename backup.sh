#!bash
# Created by Lee, Jun Seok <lego3410@gmail.com> at Jul 31, 2020

DIR=$(dirname $0)
DATE=$(date +%Y%m%d-%H%M)
BACKUPDIR=$DIR/backups/$DATE

source $DIR/.env

mkdir -p $BACKUPDIR

echo Creating a backup at $(date +"%Y.%m.%d %H:%M")
echo Backing up database into $BACKUPDIR/mysqldump.sql.gz...

# dump sql database from db container to a single compressed file
time docker-compose --project-directory $DIR \
    exec db mysqldump \
    -h localhost \
    -u$MYSQL_USER \
    -p$MYSQL_PASSWORD \
    wiki | gzip > $BACKUPDIR/mysqldump.sql.gz 2> $BACKUPDIR/mysql.log
echo done.

echo Backing up images into $BACKUPDIR/images.tar.gz...

# copy images directory into a compressed file
time docker cp wiki_wiki_1:/var/www/html/images - | gzip > $BACKUPDIR/images.tar.gz 2> $BACKUPDIR/images.log

echo done.

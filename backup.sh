#!bash
# Created by Lee, Jun Seok <lego3410@gmail.com> at Jul 31, 2020

DIR=$(dirname $0)
DATE=$(date +%Y%m%d-%H%M)
BACKUPDIR=$DIR/backups/$DATE

source $DIR/compose/.env

mkdir -p $BACKUPDIR

echo Backing up database into $BACKUPDIR...

# dump sql database from db container to a single compressed file
docker-compose --project-directory $DIR exec db mysqldump -h localhost -u$MYSQL_USER -p$MYSQL_PASSWORD wiki | gzip > $BACKUPDIR/mysqldump.sql.gz
echo done.

echo Backing up images into $BACKUPDIR...

# copy images directory into a compressed file
docker cp wiki_wiki_1:/var/www/html/images - | gzip > $BACKUPDIR/images.tar.gz

echo done.
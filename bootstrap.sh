#!bash
# Created by Lee, Jun Seok <lego3410@gmail.com> at Aug 2, 2020

DIR=$(dirname $0)

cp $DIR/.config.dist $DIR/.config
cp $DIR/.env.dist $DIR/.env

touch $DIR/compose/traefik/acme.json
sudo chmod 600 $DIR/compose/traefik/acme.json

#!bash
# Created by Lee, Jun Seok <lego3410@gmail.com> at Aug 2, 2020

DIR=$(dirname $0)

if [ -f "$(which python)" ]; then
    python --version
else
    echo python is not found
    exit
fi
if [ -f "$(which docker)" ]; then
    docker --version
else
    echo docker is not found
    exit
fi
if [ -f "$(which docker-compose)" ]; then
    docker-compose --version
else
    echo docker-compose is not found
    exit
fi

echo
echo Create .config, .env
DOTCONFIG=$DIR/.config
DOTENV=$DIR/.env
if [ -f "$DOTCONFIG" ]; then
    echo $DOTCONFIG exists. Skipping...
else
    cp $DIR/.config.dist $DOTCONFIG
fi
if [ -f "$DOTENV" ]; then
    echo $DOTENV exists. Skipping...
else
    cp $DIR/.env.dist $DOTENV
fi

echo Create file compose/traefik/acme.json permission 600
touch $DIR/compose/traefik/acme.json
sudo chmod 600 $DIR/compose/traefik/acme.json

echo
echo Generate WG_SECRETKEY and WG_UPGRADEKEY...
./keygen.py
echo Copy and paste these keys in .config
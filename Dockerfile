ARG MEDIAWIKI_VERSION=1.34.2
FROM mediawiki:${MEDIAWIKI_VERSION}

RUN apt-get update && apt-get install -y wget ghostscript imagemagick xpdf-utils

# Download Extensions and Skins
COPY extensions.txt /var/www/html/extensions
COPY skins.txt /var/www/html/skins

WORKDIR /var/www/html/extensions

RUN while read file; do \
      wget -nv -O - ${file} | tar xzf -; \
    done < extensions.txt

WORKDIR /var/www/html/skins
RUN while read file; do \
      wget -nv -O - ${file} | tar xzf -; \
    done < skins.txt

COPY ./upload.ini /usr/local/etc/php/conf.d/
COPY ./LocalSettings.php /var/www/html/

WORKDIR /var/www/html

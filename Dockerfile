ARG MEDIAWIKI_VERSION=stable
FROM mediawiki:${MEDIAWIKI_VERSION} as installer

RUN apt-get update && apt-get install -y wget ghostscript imagemagick xpdf-utils

# Download Extensions and Skins
COPY extensions.txt skins.txt /

WORKDIR /var/www/html/extensions
RUN while read file; do \
      wget -nv -O - ${file} | tar xzf -; \
    done < /extensions.txt

WORKDIR /var/www/html/skins
RUN while read file; do \
      wget -nv -O - ${file} | tar xzf -; \
    done < /skins.txt

COPY ./upload.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/html


FROM installer

COPY ./LocalSettings.php /var/www/html/

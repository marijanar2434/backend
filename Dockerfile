FROM mikroe/php-cli:latest

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install mariadb-server nginx build-essential libsqlite3-dev ruby-dev -y && \
    gem install sqlite3 -v '1.4.0' && \
    gem install mailcatcher -v 0.6.5 --no-ri --no-rdoc && \
    mkdir -p /run/mysqld && \
    mkdir -p /docker-entrypoint-initdb.d && \
    chown root:mysql /run/mysqld -R && \
    chmod 775 /run/mysqld/ -R

COPY . /var/www/html/
COPY .env /var/www/html/.env

COPY .docker/backend/php.ini /usr/local/etc/php/php.ini

RUN /usr/local/bin/composer install --no-interaction --working-dir=/var/www/html

COPY .docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY .docker/supervisor/conf.d /etc/supervisor/conf.d

COPY .docker/web/nginx.conf /etc/nginx/nginx.conf
COPY .docker/web/conf.d /etc/nginx/conf.d

COPY .docker/database/init.sql /docker-entrypoint-initdb.d/init.sql

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod 777 /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
FROM mysql:8.0

ENV MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
ENV MYSQL_DATABASE=${MYSQL_DATABASE}

# Copy initialization script
COPY ./docker/mysql/init_database.sql /docker-entrypoint-initdb.d/01-init.sql

EXPOSE 3306
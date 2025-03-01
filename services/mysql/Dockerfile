FROM mysql:8.2.0

ADD ./bootstrap /docker-entrypoint-initdb.d
ADD ./config /etc/mysql/conf.d

CMD ["mysqld"]

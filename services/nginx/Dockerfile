FROM nginx:1.25.1

RUN apt update && apt install -y \
    apache2-utils

ADD ./config /etc/nginx

CMD ["nginx", "-g", "daemon off;"]

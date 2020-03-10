FROM nginx:1.16-alpine

RUN apk --no-cache add gettext

COPY build/nginx/nginx.conf /etc/nginx/
COPY build/nginx/vhost.template /etc/nginx/conf.d/

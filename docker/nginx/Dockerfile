FROM nginx:1.23.3
COPY ./docker/nginx/default.conf    /etc/nginx/conf.d/default.conf
#COPY template    /etc/nginx/conf.d/
#RUN envsubst '$PHP_HOST' < /etc/nginx/conf.d/template > /etc/nginx/conf.d/default.conf
COPY . /var/www

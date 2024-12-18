MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"


server {
listen 80;
server_name localhost;

root /var/www/html/public;
location / {
try_files $uri /index.php$is_args$args;
}

location ~ ^/index\.php$(/|$) {
include fastcgi_params;
fastcgi_pass php-fpm:9000;
fastcgi_index index.php;
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
}

location ~ \.php$ {
return 404;
}
}

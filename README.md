Развертывание приложения

Устанавливаем Yii2-advanced шаблон:

- composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application


Инициализируем приложение:

- /path/to/php-bin/php /path/to/yii-application/init


Создаем БД, настраиваем @common/config/main.php

Накатываем миграции:

- php yii migrate

Настраиваем nginx:

- server {
        charset utf-8;
        client_max_body_size 128M;

        listen 80; ## listen for ipv4
        #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

        server_name {your-host};
        root        /var/www/{your-dir}/frontend/web/;
        index       index.php;

        #access_log  /var/www/yii2/log/frontend-access.log;
        #error_log   /var/www/yii2/log/frontend-error.log;

        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php$is_args$args;
        }

        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        # deny accessing php files for the /assets directory
        location ~ ^/assets/.*\.php$ {
            deny all;
        }

        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            #fastcgi_pass 127.0.0.1:9000;
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            try_files $uri =404;
        }
    
        location ~* /\. {
            deny all;
        }
  }

  server {
        charset utf-8;
        client_max_body_size 128M;

        listen 80; ## listen for ipv4
        #listen [::]:80 default_server ipv6only=on; ## listen for ipv6
    
        server_name {your-host};
        root        /var/www/{your-dir}/backend/web/;
        index       index.php;
    
        #access_log  /var/www/yii2/log/backend-access.log;
        #error_log   /var/www/yii2/log/backend-error.log;
    
        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php$is_args$args;
        }
    
        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        # deny accessing php files for the /assets directory
        location ~ ^/assets/.*\.php$ {
            deny all;
        }

        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            #fastcgi_pass 127.0.0.1:9000;
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            try_files $uri =404;
        }
    
        location ~* /\. {
            deny all;
        }
  }

Для получения токена доступа к API необходимо выполнить команду:

- php yii cron/get-token api password

Токен необходимо использовать в заголовке Authorization: Bearer {api_token}

Запрос к API производится по роуту {front-host}/api/send-json
При GET-запросе данные необходимо передать через параметр data
При POST-запросе нужно просто отправить валидный JSON указав заголовок Content-Type: application/json

-----------------------------------------------------

Для тестов необзодимо выполнить следующие команды

- composer require --dev codeception/module-yii2
- codecept build
- codecept run

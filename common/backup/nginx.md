#nginx配置
    server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name www.yooao.cc yooao.cc;                     ##前台域名
    root        /alidata/www/default/yooao/frontend/web;   ##这是前台index地址
    index       index.php;


    #access_log  /var/www/yii-test/access.frontend.log main;
    #error_log   /var/www/yii-test/error.frontend.log;

    location / {
        # Redirect everything that isn't a real file to index.php
        try_files $uri $uri/ /index.php?$args;
    }        

    location ~ \.php$ {
        include fastcgi.conf;
        fastcgi_pass   127.0.0.1:9000;
        #fastcgi_pass unix:/var/run/php5-fpm.sock;
        try_files $uri =404;
    }
    
    #error_page 404 /404.html;

    location ~ /\.(ht|svn|git) {
        deny all;
    }
}
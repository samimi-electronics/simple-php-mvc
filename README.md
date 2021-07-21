# Simple PHP MVC

This is a simple PHP **M**odel **V**iew **C**ontroller implementation using the help of [this youtube playlist](https://www.youtube.com/playlist?list=PLfdtiltiRHWGXVHXX09fxXDi-DqInchFD).

The web server I used is [Nginx](https://nginx.org/), that's why there is no ```.htaccess``` files in the repo. If you follow [the playlist](https://www.youtube.com/playlist?list=PLfdtiltiRHWGXVHXX09fxXDi-DqInchFD) step by step, he teaches how to setup the ```.htaccess``` files.

My nginx server block: [^1]
```
server {
        listen 80;
        listen [::]:80;

        root /var/www/php-mvc/public;
        index index.php;

        server_name php-mvc.ioc www.php-mvc.ioc;

        location / {
                try_files $uri $uri/ @rewrite;
        }

        location @rewrite {
                rewrite ^/(.*)$ /index.php?url=$1 last;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        }
}
```
Change the ```server_name``` variable to your desired server name. Make sure that the server name is defined in your hosts file.

If you choose not to define your own ```server_name```, add this entry to your hosts file:
[^2]
[^3]
```
127.0.0.1 php-mvc.ioc www.php-mvc.ioc
```
[^1]: [How to setup virtual host on nginx?](https://www.youtube.com/watch?v=WEIo9f4QbYM)

[^2]: [How to add hosts entry on windows?](https://www.youtube.com/watch?v=oQFpR6mKuKg)

[^3]: [How to add hosts entry on linux?](https://www.youtube.com/watch?v=Kl6Kwvc-EYs)
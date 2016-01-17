## ycf framework


* a very simple PHP framework  for api or cli 


## Requirements

* PHP 5.3+


## Installation

1. git clone https://github.com/kcloze/ycf.git your-app
2. cd your-app and run: composer install
3. cd src/runtime and chmod -R 777 runtime/
4. edit src/settings.ini.php for mysql config

5.1  
run in php-fpm: Open your browser and enter http://youhost/index.php?ycf=hello&act=hello

5.1.2 
if set nginx as follow,url can be simple: http://youhost/hello/hello

```
                location / {
                        if (!-e $request_filename){
                                 rewrite ^/(.*) /index.php last;
                         }
                }

```

5.2 
run in cli: /opt/php7/bin/php index.php ycf=hello act=hello

## Documentation
 * in src/service/ ,you can add your business code here
 * Naming Conventions: 
 * ---service class name :YcfYourname.php
 * ---method name : public static function actionYourname()
 * [DB Class Use](DB_README.md)
 * if you need redis,shoud install phpredis extention(https://github.com/phpredis/phpredis)

## Beanchmarks
1. ab -c100 -n1000 "http://yourhost/index.php"

## Community
mail: pei.greet@gmail.com
qq群: 141059677


##License
The ycf framework is open-sourced software licensed under the MIT license


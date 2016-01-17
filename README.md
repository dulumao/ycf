## ycf framework


* a very simple PHP framework  for api or cli or swoole


## Requirements

* PHP 5.3+


## Installation

1. git clone https://github.com/kcloze/ycf.git your-app
2. cd your-app and run: composer install
3. cd src/runtime and chmod -R 777 runtime/
4. edit src/settings.ini.php for mysql config

## How to run

###php-fpm  
run in php-fpm: Open your browser and enter http://youhost/index.php?ycf=hello&act=hello

5.1.2 if set nginx as follow,url can be simple: http://youhost/hello/hello

```
                location / {
                        if (!-e $request_filename){
                                 rewrite ^/(.*) /index.php last;
                         }
                }

```

###cli
5.2 run in cli: /opt/php7/bin/php index.php ycf=hello act=hello

###swoole
5.3 run with swoole: /opt/php7/bin/php server.php



## Documentation
 * in src/service/ ,you can add your business code here
 * Naming Conventions: 
 * ---service class name :YcfYourname.php
 * ---method name : public static function actionYourname()
 * [DB Class Use](DB_README.md)
 * if you need redis,shoud install phpredis extention(https://github.com/phpredis/phpredis)

## Beanchmarks
1. computer info: 
CPU(s):               2
CPU MHz：             2401.000
Mem:                  4G

fpm config:
pm = dynamic
pm.max_children = 150
pm.start_servers = 20

swoole config:
worker_num=4
max_request=1000


2. ab -c100 -n1000 "http://yourhost/index.php"

###php7 with php-fpm:
```
Server Software:        nginx/1.4.6
Server Hostname:        ycf.kcloze.cn
Server Port:            80

Document Path:          /
Document Length:        9 bytes

Concurrency Level:      10
Time taken for tests:   0.035 seconds
Complete requests:      100
Failed requests:        0
Total transferred:      17900 bytes
HTML transferred:       900 bytes
Requests per second:    2862.38 [#/sec] (mean)
Time per request:       3.494 [ms] (mean)
Time per request:       0.349 [ms] (mean, across all concurrent requests)
Transfer rate:          500.36 [Kbytes/sec] received


```


###php7 with swoole:
```
Server Software:        swoole-http-server
Server Hostname:        localhost
Server Port:            9501

Document Path:          /
Document Length:        9 bytes

Concurrency Level:      10
Time taken for tests:   0.017 seconds
Complete requests:      100
Failed requests:        0
Total transferred:      15600 bytes
HTML transferred:       900 bytes
Requests per second:    5932.61 [#/sec] (mean)
Time per request:       1.686 [ms] (mean)
Time per request:       0.169 [ms] (mean, across all concurrent requests)
Transfer rate:          903.80 [Kbytes/sec] received

```

## Community
mail: pei.greet@gmail.com
qq群: 141059677


##License
The ycf framework is open-sourced software licensed under the MIT license


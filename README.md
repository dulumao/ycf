## ycf framework


* a very simple php framework  for api or cli 


## Requirements

* PHP 5+


## How to run

1. git clone https://github.com/kcloze/ycf.git
2. cd runtime and chmod -R 755 runtime/
3. Open your browser and enter http://youhost/index.php
4. run in cli: /opt/php7/bin/php index.php ctr=YcfHello act=hello
5. test db curd,you need to set core/settings.ini.php

## Beanchmarks
1. ab -c100 -n1000 "http://yourhost/index.php"





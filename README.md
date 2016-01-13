## ycf framework


* a very simple php framework  for api or cli 


## Requirements

* PHP 5+


## How to run

1. git clone https://github.com/kcloze/ycf.git
2. cd runtime and chown -R www:www runtime/
3. Open your browser and enter http://youhost/index.php
4. run in cli: /opt/php7/bin/php index.php ctr=YcfHello act=hello
5. test db curd,you need to set core/settings.ini.php

## Beanchmarks
1. ab -c100 -n100 "http://yourhost/ycf_fastdfs/test/test.php?fname=001"
2. fname param can set 001,002,003,004;it's different file size to beanchmark

##Thanks



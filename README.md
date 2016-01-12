## fastdfs_upload


* a simple php framework  for fastdfs


## Requirements

* PHP 7+
* fastdfs 5.0+
* fastdfs PHP extension
* Linux

## Installation 
1. Installation fastdfs,refer to 

   https://github.com/xikai/fastdfs/blob/master/INSTALL
    
2. Install PHP extension,refer to

    https://github.com/xikai/fastdfs/tree/master/php_client

## How to run

1. git clone https://github.com/kcloze/fastdfs_upload.git
2. chown -R www:www runtime/
3. Open your browser and enter http://youhost/test/index.php

## Beanchmarks
1. ab -c100 -n100 "http://yourhost/ycf_fastdfs/test/test.php?fname=001"
2. fname param can set 001,002,003,004;it's different file size to beanchmark

##Thanks
1. https://github.com/xikai/fastdfs


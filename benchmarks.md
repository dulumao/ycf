
## Benchmarks
####1. computer and config info: 
```
Architecture:          x86_64
CPU op-mode(s):        32-bit, 64-bit
Byte Order:            Little Endian
CPU(s):                2
On-line CPU(s) list:   0,1
Thread(s) per core:    1
Core(s) per socket:    2
Socket(s):             1
NUMA node(s):          1
Vendor ID:             GenuineIntel
CPU family:            6
Model:                 60
Stepping:              3
CPU MHz:               800.000
BogoMIPS:              5587.05
Virtualization:        VT-x
L1d cache:             32K
L1i cache:             32K
L2 cache:              256K
L3 cache:              2048K
NUMA node0 CPU(s):     0,1

Mem:                  4G

fpm config:
pm = dynamic
pm.max_children = 150
pm.start_servers = 20

swoole config:
worker_num=8
max_request=1000

```


##Benchmarks:echo hello world
####2. ab -c100 -n1000 "http://192.168.10.244/kcloze/index.php?ycf=hello&act=index"
code in here:(https://github.com/kcloze/ycf/blob/master/src%2FService%2FYcfHello.php)

###php7 with php-fpm:
```
Server Software:        nginx/1.6.3
Server Hostname:        192.168.10.244
Server Port:            80

Document Path:          /kcloze/index.php
Document Length:        15 bytes

Concurrency Level:      200
Time taken for tests:   0.803 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      176000 bytes
HTML transferred:       15000 bytes
Requests per second:    1245.99 [#/sec] (mean)
Time per request:       160.515 [ms] (mean)
Time per request:       0.803 [ms] (mean, across all concurrent requests)
Transfer rate:          214.15 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.4      0       2
Processing:     3  144  42.4    154     286
Waiting:        3  144  42.4    154     286
Total:          4  144  42.2    154     286

Percentage of the requests served within a certain time (ms)
  50%    154
  66%    158
  75%    162
  80%    165
  90%    179
  95%    186
  98%    191
  99%    203
 100%    286 (longest request)
```

###php7 with swoole-http-server:
```
Server Software:        swoole-http-server
Server Hostname:        192.168.10.244
Server Port:            9501

Document Path:          /kcloze/index.php
Document Length:        15 bytes

Concurrency Level:      200
Time taken for tests:   0.034 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      163163 bytes
HTML transferred:       15015 bytes
Requests per second:    29183.45 [#/sec] (mean)
Time per request:       6.853 [ms] (mean)
Time per request:       0.034 [ms] (mean, across all concurrent requests)
Transfer rate:          4650.06 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   0.3      1       1
Processing:     2    6   1.7      5      10
Waiting:        2    5   1.7      5      10
Total:          3    6   1.8      6      11

Percentage of the requests served within a certain time (ms)
  50%      6
  66%      6
  75%      7
  80%      7
  90%      9
  95%     10
  98%     11
  99%     11
 100%     11 (longest request)
```

##Benchmarks:insert one record and select on record

####2. ab -c100 -n1000 "http://192.168.10.244/kcloze/index.php?ycf=pdo&act=test"
code in here:(https://github.com/kcloze/ycf/blob/master/src%2FService%2FYcfPdo.php)

###php7 with php-fpm:
```
Server Software:        nginx/1.6.3
Server Hostname:        192.168.10.244
Server Port:            80

Document Path:          /kcloze/index.php?ycf=pdo&act=test
Document Length:        174 bytes

Concurrency Level:      100
Time taken for tests:   1.108 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      335000 bytes
HTML transferred:       174000 bytes
Requests per second:    902.44 [#/sec] (mean)
Time per request:       110.810 [ms] (mean)
Time per request:       1.108 [ms] (mean, across all concurrent requests)
Transfer rate:          295.23 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.5      0       3
Processing:    16  106  30.6    105     289
Waiting:       16  105  30.6    105     289
Total:         17  106  30.5    105     289

Percentage of the requests served within a certain time (ms)
  50%    105
  66%    114
  75%    118
  80%    120
  90%    136
  95%    157
  98%    199
  99%    206
 100%    289 (longest request)
```



###php7 with swoole-http-server:

```
Server Software:        swoole-http-server
Server Hostname:        192.168.10.244
Server Port:            9501

Document Path:          /kcloze/index.php?ycf=pdo&act=test
Document Length:        163 bytes

Concurrency Level:      100
Time taken for tests:   0.596 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      312000 bytes
HTML transferred:       163000 bytes
Requests per second:    1676.47 [#/sec] (mean)
Time per request:       59.649 [ms] (mean)
Time per request:       0.596 [ms] (mean, across all concurrent requests)
Transfer rate:          510.80 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.2      0       1
Processing:     5   56  19.4     54     106
Waiting:        5   56  19.4     54     106
Total:          6   57  19.3     54     106

Percentage of the requests served within a certain time (ms)
  50%     54
  66%     63
  75%     66
  80%     69
  90%     86
  95%     95
  98%    101
  99%    103
 100%    106 (longest request)
 ```
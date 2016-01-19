
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
Server Software:        nginx/1.6.3
Server Hostname:        192.168.10.244
Server Port:            80

Document Path:          /kcloze/index.php?ycf=hello&act=index
Document Length:        21 bytes

Concurrency Level:      100
Time taken for tests:   0.228 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      182182 bytes
HTML transferred:       21021 bytes
Requests per second:    4393.92 [#/sec] (mean)
Time per request:       22.759 [ms] (mean)
Time per request:       0.228 [ms] (mean, across all concurrent requests)
Transfer rate:          781.73 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.2      0       1
Processing:     3   22   2.7     22      28
Waiting:        3   22   2.7     22      28
Total:          3   22   2.5     22      28

Percentage of the requests served within a certain time (ms)
  50%     22
  66%     22
  75%     22
  80%     22
  90%     22
  95%     22
  98%     25
  99%     27
 100%     28 (longest request)
```

###php7 with swoole-http-server:
```
Server Software:        swoole-http-server
Server Hostname:        192.168.10.244
Server Port:            9501

Document Path:          /kcloze/index.php?ycf=hello&act=index
Document Length:        9 bytes

Concurrency Level:      200
Time taken for tests:   0.054 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      156000 bytes
HTML transferred:       9000 bytes
Requests per second:    18540.49 [#/sec] (mean)
Time per request:       10.787 [ms] (mean)
Time per request:       0.054 [ms] (mean, across all concurrent requests)
Transfer rate:          2824.53 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.6      0       2
Processing:     0    9   7.6      7      28
Waiting:        0    9   7.6      7      28
Total:          0   10   7.6      8      29

Percentage of the requests served within a certain time (ms)
  50%      8
  66%     12
  75%     15
  80%     17
  90%     22
  95%     25
  98%     27
  99%     28
 100%     29 (longest request)

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
Document Length:        175 bytes

Concurrency Level:      100
Time taken for tests:   0.405 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      336000 bytes
HTML transferred:       175000 bytes
Requests per second:    2469.77 [#/sec] (mean)
Time per request:       40.490 [ms] (mean)
Time per request:       0.405 [ms] (mean, across all concurrent requests)
Transfer rate:          810.39 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.2      0       1
Processing:     9   38   6.4     39      78
Waiting:        9   38   6.4     39      78
Total:         10   38   6.3     39      78

Percentage of the requests served within a certain time (ms)
  50%     39
  66%     41
  75%     42
  80%     43
  90%     44
  95%     46
  98%     49
  99%     52
 100%     78 (longest request)
 
```



###php7 with swoole-http-server:

```
SServer Software:        swoole-http-server
Server Hostname:        192.168.10.244
Server Port:            9501

Document Path:          /kcloze/index.php?ycf=pdo&act=test
Document Length:        163 bytes

Concurrency Level:      200
Time taken for tests:   0.915 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      312000 bytes
HTML transferred:       163000 bytes
Requests per second:    1093.10 [#/sec] (mean)
Time per request:       182.967 [ms] (mean)
Time per request:       0.915 [ms] (mean, across all concurrent requests)
Transfer rate:          333.05 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.7      0       2
Processing:     7  164  42.0    179     207
Waiting:        7  164  42.0    179     207
Total:          9  165  41.5    179     207

Percentage of the requests served within a certain time (ms)
  50%    179
  66%    185
  75%    187
  80%    189
  90%    192
  95%    195
  98%    200
  99%    203
 100%    207 (longest request)
 ```
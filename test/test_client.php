<?php

require_once('../include/FDFSClientLib.php');

$publicFDFSClient= new publicFDFSClient();

$rs=$publicFDFSClient->uploadByFileName('./test.json');

var_dump($rs);

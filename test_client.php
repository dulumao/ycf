<?php

require_once('FDFSClientLib.php');

$publicFDFSClient= new publicFDFSClient();

$rs=$publicFDFSClient->uploadByFileName('./test.json');

var_dump($rs);

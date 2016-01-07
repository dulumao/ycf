<?php
require_once('fastdfs.php');

$fdfs = new FDFS();

$localfile = 'test.json';
$fileinfo = $fdfs->upload($localfile,'json');

if ($fileinfo) {
  // update file info in the database etc
}

var_dump($fileinfo);

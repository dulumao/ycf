<?php
require_once('fastdfs.php');

$fdfs = new FDFS();

$localfile = 'test.xml';
$fileinfo = $fdfs->upload($localfile,'xml');

if ($fileinfo) {
  // update file info in the database etc
}

var_dump($fileinfo);

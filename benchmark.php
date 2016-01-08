<?php
require_once('fastdfs.php');

$fdfs = new FDFS();


$localfile = $_GET['fname']?$_GET['fname']:'001';
$fileinfo = $fdfs->upload('upload/'.$localfile,'');
$fdfs->closs();//一定要释放连接
if ($fileinfo) {
    echo 'true';
}else{
    echo 'false';
}




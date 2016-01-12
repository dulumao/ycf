<?php
require_once('../include/FDFS.php');

$fdfs = new FDFS();


$localfile = $_GET['fname']?$_GET['fname']:'001';
$fileinfo = $fdfs->upload('upload/'.$localfile,'');

if ($fileinfo) {
    $result=$fdfs->download_to_buff($fileinfo['group_name'],$fileinfo['remote_filename']);
    var_dump("file size is : ".strlen($result));
    //update file info in the database etc
}else{
    var_dump($fdfs->getError());
}

var_dump($fileinfo);
$fdfs->closs();//一定要释放连接

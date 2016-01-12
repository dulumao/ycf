<?php
require_once('../include/FDFS.php');

$fdfs = new FDFS();


$localfile = $_GET['fname']?$_GET['fname']:'001';
$fileinfo = $fdfs->upload('upload/'.$localfile,'');


if ($fileinfo) {
    $fdfs->download_to_buff($fileinfo['group_name'],$fileinfo['remote_filename']);
    echo 'true';
}else{
    echo 'false';
}
$fdfs->closs();//一定要释放连接




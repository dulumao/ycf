<?php
date_default_timezone_set('Asia/Shanghai');
define('APP_DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__)) . DS);


require_once('include/main.php');

$fdfs = new FDFS();

if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
else {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
        $origin_file_name = $_FILES["file"]["name"];
        $fileinfo = $fdfs->upload('upload/'.$localfile,'');

        if ($fileinfo) {
            $result=$fdfs->download_to_buff($fileinfo['group_name'],$fileinfo['remote_filename']);
            var_dump($result);
            //update file info in the database etc
        }else{
            var_dump($fdfs->getError());
        }

        var_dump($fileinfo);
        $fdfs->closs();//一定要释放连接
}



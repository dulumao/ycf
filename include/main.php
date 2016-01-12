<?php
spl_autoload_register(function ($name) {
            $file_path = ROOT_PATH . "include" . DS . $name . ".php";
            if(!file_exists($file_path)){
                die('class no exits');
            }
            include $file_path;
});

$action=isset($_REQUEST['action'])?$_REQUEST['action']:'hello';
$action_name='action'.ucfirst($action))
if(method_exists('YcfUpload',$action_name)){
    YcfUpload::$action_name();
} 

<?php
XUtils::spl_autoload_register();

$action=$_REQUEST['action']?$_REQUEST['action']:'hello';

if(method_exists('YcfUpload','action'.ucfirst($action))){
    YcfUpload::$action();
} 

<?php
spl_autoload_register(function ($name) {
            $file_path = ROOT_PATH . "core" . DS . $name . ".php";
            if(file_exists($file_path)){
                include $file_path;
            }
            $file_path = ROOT_PATH . "service" . DS . $name . ".php";
            if(file_exists($file_path)){
                include $file_path;
            }
});

/**
*cli use this:  /opt/php7/bin/php index.php ctr=YcfPdo act=test
*
*/
if(php_sapi_name()=="cli"){
	foreach ($argv as $arg) {
    $e=explode("=",$arg);
    if(count($e)==2)
        $_REQUEST[$e[0]]=$e[1];
    else    
        $_REQUEST[$e[0]]=0;
    }
}

$action=isset($_REQUEST['act'])?$_REQUEST['act']:'hello';
$ycf_name=isset($_REQUEST['ycf'])?$_REQUEST['ycf']:'YcfHello';
$action_name='action'.ucfirst($action);

if(method_exists($ycf_name,$action_name)){
    YcfCore::init();
    $ycf_name::$action_name();
}else{
	die("action not find");
}

class YcfCore{
    static $_settings=array();
    static $_db='';

    static  function init(){
        self::$_settings = parse_ini_file("settings.ini.php");
        self::getDbInstance();
    } 

    static  function getDbInstance(){
        if(self::$_db==''){
            self::$_db=new YcfDB();
        }
    }
}

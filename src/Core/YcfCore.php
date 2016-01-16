<?php

namespace Ycf\Core;

use Ycf\Core\YcfDB;

class YcfCore{
    static $_settings=array();
    static $_db='';

    static  function init(){
        self::spl_autoload_register();
        self::$_settings = parse_ini_file("settings.ini.php");
        self::getDbInstance();
    } 
    /**
     * 注册类库载入路径
     */
    static public function spl_autoload_register()
    {
        spl_autoload_register(function ($name) {
            $file_path = ROOT_PATH . "Core" . DS . $name . ".php";
            if(!file_exists($file_path)){
                $file_path = ROOT_PATH . "Service" . DS . $name . ".php";
            }
            include $file_path;
        });
    }

    static  public function getDbInstance(){
        if(self::$_db==''){
            self::$_db=new YcfDB();
        }
    }

    static public function run(){
        /**
        *cli use this:  /opt/php7/bin/php index.php ycf=YcfPdo act=test
        *
        */
        
        if(php_sapi_name()=="cli"){
            global $argv;
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

        echo "Ycf\Service\\".$ycf_name."\r\n";
        echo $action_name."\r\n";
        if(method_exists("Ycf\Service\\".$ycf_name,$action_name)){
            self::init();
            "Ycf\Service\\".$ycf_name::$action_name();
        }else{
            die("action not find");
        }

    }
}

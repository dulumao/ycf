<?php
class YcfDb{
    public static $db='';

    private static function getDbInstance(){
        if(self::$db==''){
            self::$db=new DB();
        }
        //return self::$db;
    }
    /**
     * 插入文件信息
     * @return [type] [description]
     */
    public static function insertFileInfo($data){
        self::getDbInstance();
        $insert = self::$db->query("INSERT INTO dfs_file_info( url,productId,createTime,state,privateState,cityCode,realName,extName,fileSize,fileWidth,fileHeight) VALUES (  :url,:productId,:createTime,:state,:privateState,:cityCode,:realName,:extName,:fileSize,:fileWidth,:fileHeight)", $data);
        if($insert > 0 ) {
            return $db->lastInsertId();
        }else{
            return false;
        }

    }
    /**
     * [插入tag信息]
     * @return [type] [description]
     */
    public static function insertTag($data){
        self::getDbInstance();
        $insert = self::$db->query("INSERT INTO dfs_file_info( fileId,tagValue,tagKey,createTime) VALUES ( :fileId,:tagValue,:tagKey,:createTime)", $data);
        if($insert > 0 ) {
            return  $db->lastInsertId();
        }else{
            return false;
        }
    }

}

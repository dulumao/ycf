<?php
class FileFilter{

    public static $error='';
    public static $extensin_name='';

    /**
     * 取得上传文件的后缀
     * @access private
     * @param string $filename 文件名
     * @return boolean
     */
    public static function getExt($filename) {
        $pathinfo = pathinfo($filename);
        self::$extensin_name=$pathinfo['extension'];
        return self::$extensin_name;
    }


    public static function checkExtName($file){
        $file['extension']=self::getExt($file["name"]);
        // 如果是图像文件 检测文件格式
        if(isset($file['extension']) && in_array(strtolower($file['extension']),array('gif','jpg','jpeg','bmp','png','swf'))) {
            $info   = getimagesize($file['tmp_name']);
            if(false === $info || ('gif' == strtolower($file['extension']) && empty($info['bits']))){
                self::$error = '非法图像文件';
                return false;                
            }
        }
        return true;
    }

}
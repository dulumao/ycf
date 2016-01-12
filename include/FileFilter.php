<?php
class FileFilter{


    public static checkExtensinName($file){

        // 如果是图像文件 检测文件格式
        if( in_array(strtolower($file['extension']),array('gif','jpg','jpeg','bmp','png','swf'))) {
            $info   = getimagesize($file['tmp_name']);
            if(false === $info || ('gif' == strtolower($file['extension']) && empty($info['bits']))){
                $this->error = '非法图像文件';
                return false;                
            }
        }
    }

}
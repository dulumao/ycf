<?php
/**
 * 业务封装类
 * 
 *
 */
class YcfUpload {
    public static function actionUpload(){
        $log_ms="";
        $fdfs = new FDFS();
        if (XUtils::method() == 'POST' && isset($_FILES["file"]) && !empty($_FILES["file"])) {
            if ($_FILES["file"]["error"] > 0) {
                    $log_ms.= "Return Code: " . $_FILES["file"]["error"] . "\r\n";
            }
            else {
                    $ext_name=FileFilter::getExt($_FILES["file"]["name"]);
                    if(!FileFilter::checkExtName($_FILES["file"])){
                        echo json_encode(array('code'=>501,'message'=>FileFilter::$error));
                        return;
                    }

                    $log_ms.= "Upload: " . $_FILES["file"]["name"] . "\r\n";
                    $log_ms.= "Type: " . $_FILES["file"]["type"] . "\r\n";
                    $log_ms.= "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb\r\n";
                    $log_ms.= "Temp file: " . $_FILES["file"]["tmp_name"] . "\r\n";
                    $origin_file_name = $_FILES["file"]["tmp_name"];

                    XUtils::log($log_ms,'upload');
                    $log_ms='';
                    $fileinfo = $fdfs->upload($origin_file_name,$ext_name);

                    if ($fileinfo) {
                        $fileinfo['ext_name']=$ext_name;
                        $fileinfo['remote_url']=$fileinfo['group_name'].'/'.$fileinfo['remote_filename'];
                        echo json_encode(array('code'=>200,'message'=>'success','content'=>$fileinfo));
                        //$result=$fdfs->download_to_buff($fileinfo['group_name'],$fileinfo['remote_filename']);
                        //update file info in the database etc
                        //url,productId,createTime,state,privateState,cityCode,realName,extName,fileSize,fileWidth,fileHeight
                        $data_file['url']=$fileinfo['remote_url'];
                        $data_file['productId']=isset($_REQUEST['productId'])?$_REQUEST['productId']:0;
                        $data_file['createTime']=time();
                        $data_file['cityCode']=isset($_REQUEST['cityCode'])?$_REQUEST['cityCode']:'000000';
                        $data_file['realName']=$_FILES["file"]["name"];
                        $data_file['extName']=$fileinfo['ext_name'];
                        $data_file['fileSize']=$fileinfo['file_size'];
                        $data_file['fileSize']=$fileinfo['file_size'];
                        $data_file['fileWidth']=FileFilter::$width;
                        $data_file['fileHeight']=FileFilter::$height;
                        $data_file['privateState']=isset($_REQUEST['dfsPrivate'])?$_REQUEST['dfsPrivate']:1;
                        XUtils::log(serailize($data_file),'upload');
                        $log_ms='';
                        //插入文件信息表
                        $fileId=YcfDb::insertFileInfo($data_file);
                        if($fileId && isset($_REQUEST['dfsTag'])){
                            $data_tag=json_decode($_REQUEST['dfsTag']);
                            if(!empty($data_tag)){
                                foreach ((array)$data_tag as $key => $value) {
                                    $tags['tagKey']=$key;
                                    $tags['tagValue']=$value;
                                    $tags['fileId']=$fileId;
                                    //插入文件tag信息
                                    YcfDb::insertTag($tags);
                                }
                                
                            }
                        }

                    }else{
                        $log_ms="Get error: ".serialize($fdfs->getError()). "\r\n";
                    }
                    $log_ms.="Result: ".serialize($fileinfo). "\r\n";
                    XUtils::log($log_ms,'upload');
                    //一定要释放连接
                    $fdfs->closs();
                    return;
            }
        }else{
            echo json_encode(array('code'=>500,'message'=>'no file input','content'=>''));
            return;
        }

    }

    public static function actionHello(){
        echo json_encode(array('code'=>100,'message'=>'hello fastdfs','content'=>'hello ycf'));
        return;
    }


}
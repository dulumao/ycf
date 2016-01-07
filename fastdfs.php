<?php
// fastdfs.php
class Fdfs {
    private $fdfs, $tracker, $storage;
    public function __construct() {
        $this->fdfs = new FastDFS();

        // get a connected tracker server
        $this->tracker = $this->fdfs->tracker_get_connection();
        if (!$this->tracker) {
            throw new Exception('cannot connect to tracker server:[' .  
                $this->fdfs->get_last_error_no() . '] ' . 
                $this->fdfs->get_last_error_info());
        }

        // get the storage server info and connect to it
        $this->storage = $this->fdfs->tracker_query_storage_store();
        $this->server = $this->fdfs->connect_server(
            $this->storage['ip_addr'], $this->storage['port']);
        if ($this->server === false) {
            throw new Exception('cannot connect to storage server' . 
                $this->storage['ip_addr'] . ':' . 
                $this->storage['port'] .  ' :[' .  
                $this->fdfs->get_last);
        }
        $this->storage['sock'] = $this->server['sock'];
    }
   
    public function upload($localfile, $ext_name) {
        
        var_dump($this->tracker, $this->storage, $this->server);
        $info = $this->fdfs->storage_upload_by_filename($localfile);
        var_dump($localfile);exit;
        $info = $this->fdfs->storage_upload_by_filename($localfile, $ext_name, 
            array(), null, $this->tracker, $this->storage);
        if (is_array($info)) {
            $group_name = $info['group_name'];
            $remote_filename = $info['filename'];
            $source_info = $this->fdfs->get_file_info($group_name, 
                $remote_filename);
            $source_ip = $source_info['source_ip_addr'];
            $file_size = $source_info['file_size'];
            return compact('group_name', 'remote_filename', 
                'source_ip', 'file_size');
        }
        return false;
    }

    public function download_to_buff($group_name, $remote_filename) {
        $content = $this->fdfs->storage_download_file_to_buff(
            $group_name, $remote_filename);
        return $content;
    }

    public function download_to_file($group_name, 
            $remote_filename, $dst_localfile) {
        return $this->fdfs->storage_download_file_to_file($group_name, 
            $remote_filename, $dst_localfile);
    }

    public function delete($group_name, $remote_filename) {
        return $this->fdfs->storage_delete_file($group_name, $remote_filename);
    }

    public function exists($group_name, $remote_filename) {
        return $this->fdfs->storage_file_exist($group_name, $remote_filename);
    }

    public function get_file_info($group_name, $remote_filename) {
        return $this->fdfs->get_file_info($group_name, $remote_filename);
    }
}
 <?php

 $fdfs = new FastDFS();
 echo 'tracker_make_all_connections result: ' . $fdfs->tracker_make_all_connections() . "\n";
 $tracker = $fdfs->tracker_get_connection();
 var_dump($tracker);

 $server = $fdfs->connect_server($tracker['ip_addr'], $tracker['port']);
 var_dump($server);
 var_dump($fdfs->disconnect_server($server));

 var_dump($fdfs->tracker_query_storage_store_list());

 //var_dump($fdfs->tracker_list_groups());
 //var_dump($fdfs->tracker_query_storage_store());
 //var_dump($fdfs->tracker_query_storage_update($group_name, $remote_filename));
 //var_dump($fdfs->tracker_query_storage_fetch($group_name, $remote_filename));
 //var_dump($fdfs->tracker_query_storage_list($group_name, $remote_filename));

 var_dump($fdfs->tracker_query_storage_update1($file_id));
 var_dump($fdfs->tracker_query_storage_fetch1($file_id));
 var_dump($fdfs->tracker_query_storage_list1($file_id));

 $file_info = $fdfs->storage_upload_by_filename("/usr/include/stdio.h");
 if ($file_info)
 {
    var_dump($file_info);
 }
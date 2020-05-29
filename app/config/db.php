<?php
use webrium\mysql\DB;

$config=[];

// $config['main']=[
//   'driver'=>'mysql' ,
//   'db_host'=>'localhost' ,
//   'db_host_port'=>3306 ,
//   'db_name'=>'test' ,
//   'username'=>'root' ,
//   'password'=>'1234' ,
//   'charset'=>'utf8mb4' ,
//   'result_stdClass'=>true
// ];

DB::setConfig($config);

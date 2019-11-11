<?php
error_reporting(E_ALL);
date_default_timezone_set("PRC");
define("EMS_NAME","爱尔市场部筛查组",FALSE);
define("EMS_VERSION","2.0",FALSE);
require_once ("lib/Medoo.php");
use Medoo\Medoo;
/*$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'myeflyus_ems',
    'server' => '103.99.63.48',
    'username' => 'myeflyus_ems',
    'password' => 'Lxw871207@',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
    
    //可选：端口
    'port' => 3306,
 
    //可选：表前缀
    'prefix' => '',
 
    // PDO驱动选项 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);*/
$db = new Medoo([
    'database_type' => 'sqlite',
    'database_file' => 'lib/ems.db'
]);
?>

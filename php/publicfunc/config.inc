<?php
//********************************************************************************************// 
// Filename: config.inc
// Author: Weixing Ye PhD
// Version: 1.0
// Create Date: 2018/01/30
//********************************************************************************************// 

// PHP error reporting
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);

//** Set timezone to Shanghai SGI lab location
date_default_timezone_set('Asia/Shanghai');

// MySQL database connection
$db_username = "root";
$db_password = "WelcomeSGI1";
$db_server = "192.168.202.197";
$db_name = "SGI_Knowledge_Database";
?>
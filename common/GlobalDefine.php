<?php 
//require_once dirname(__FILE__).'/ErrorCode.php';
define('ROOT_PATH', dirname(__FILE__) . '/../');
define('DEFAULT_CHARSET', 'utf-8');
define('COMPONENT_VERSION', '1.0');
define('COMPONENT_NAME', 'wxmp');

//关闭NOTICE错误日志
error_reporting(E_ALL ^ E_NOTICE);


$GLOBALS['DB'] = array(
	'DB' => array(
		'HOST' => 'pacotestdb.mysql.rds.aliyuncs.com',
		'DBNAME' => 'findface_new',
		'USER' => 'pacozhong',
		'PASSWD' => '123456',
		'PORT' => 3306 
	),
	
);
/*
$GLOBALS['DB'] = array(
	'DB' => array(
		'HOST' => 'localhost',
		'DBNAME' => 'findface',
		'USER' => 'root',
		'PASSWD' => 'root',
		'PORT' => 3306 
	),
	'MR' => array(
		'HOST' => 'localhost',
		'DBNAME' => 'mr',
		'USER' => 'root',
		'PASSWD' => 'root',
		'PORT' => 3306 
	)
);
*/
/**config for meiri10futu**/

?>

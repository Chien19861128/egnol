<?php

$g_config = array(
	'master_web' => array(
		'wan_ip' => '61.67.213.201',
		'lan_ip' => '172.16.0.201',
	),
	'slave_web' => array(
		'wan_ip' => '61.67.213.203',
		'lan_ip' => '172.16.0.203',
	),
	'office_ip' => array(
		'127.0.0.1', '61.220.44.200', '192.168.1.55', '192.168.1.72', //long_e 
		'59.124.24.123', '59.124.24.122', '59.124.24.48', '210.208.83.253', //beanfun 
		//'175.98.112.98', //omg 
		'118.163.105.85', //樓上的 
		'220.130.131.160', //巴哈
		'211.147.253.235', //昆侖
		'61.148.75.238', //仙境原廠
		'114.34.165.184', //艾斯測試登7服
		'124.74.140.254', //kingnet 鎧甲三國
		'119.77.153.5', //baca
		'218.213.105.53', //rc賀青
		'203.69.195.44', //rc賀青
	),
	'http_document_root' => (SYSTEM_OS=='window') ? 'c:/Apache24/htdocs/' : '/var/www/html/',
	'db' 		=> array(),
	'session' 	=> array(),	
);

switch (ENVIRONMENT)
{
	case 'development':
		$g_config['db'] = array(
			'hostname' 	=> 'localhost',
			'database' 	=> 'long_e',
			'username' 	=> 'root',
			'password' 	=> '123',
			'port' 		=> '3306',
			'db_debug'	=> TRUE,
		);
		$g_config['session'] = array(
			'save_handler' 	=> 'memcache',
			'save_path' 	=> 'tcp://localhost:11211?persistent=1&weight=1&timeout=1&retry_interval=15',
			'cookie_domain' => '127.0.0.1',
			'gc_maxlifetime'=> '7200',
		);
		break;

	case 'testing':
	case 'production':
		$g_config['db'] = array(
			'hostname' 	=> '172.16.0.200',
			'database' 	=> 'long_e',
			'username' 	=> '4urkD4u4X4jd',
			'password' 	=> 'ez78rwmqX38QELW7',
			'port'		=> '3306',
			'db_debug'	=> FALSE,
		);
		$g_config['session'] = array(
			'save_handler' 	=> 'memcache',
			'save_path' 	=> 'tcp://localhost:12321?persistent=1&weight=1&timeout=1&retry_interval=15',
			'cookie_domain' => '.long_e.com.tw',
			'gc_maxlifetime'=> '7200',
		);
		break;
}

<?
	if (empty($_GET['g'])) {
		header("Location: http://www.long_e.com.tw/p/file/Resources.zip");
		//http://203.75.245.100/eya/Resources.zip		
	}
	else {
		switch($_GET['g']) {
			case '1': 
				header("Location: http://www.long_e.com.tw/p/file/eya.zip");
				//http://203.75.245.100/eya/eya.zip
				break;
				
			case '2': 
				header("Location: http://www.long_e.com.tw/p/file/Resources_new.zip");
				//http://203.75.245.100/eya/eya.zip
				break;
		}
	}
?>
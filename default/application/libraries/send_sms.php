<?php
    /**
     * 
     *  yoyo8 簡訊系統發送
     *
     */
    class Send_SMS
    {
		$member_id  = 'longeplay';

        function __construct()
		{
        }

        function send($product_id, $phone_number, $msg)
		{
			$msg_id = time().rand(1,9999);
			$pwd = MD5("{$this->member_id}:leru03vmp4:{$product_id}:{$msg_id}");

			$url = "https://www.yoyo8.com.tw/SMSBridge.php
					?MemberID={$this->member_id}
					&Password={$pwd}
					&MobileNo={$phone_number}
					&CharSet=U
					&SMSMessage={$msg}
					&SourceProdID={$product_id}
					&SourceMsgID={$msg_id}
					";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_res = curl_exec($ch);
			curl_close($ch);

			$result = array();
			parse_str($curl_res, $result);

			if($result['status'] == 0)
			{
				// 成功

				return true;
			}
			else
			{
				// 失敗

				return false;
			}
        }
    }
?>

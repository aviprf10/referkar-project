<?php
function send_sms($otp_array)
{
	if(count($otp_array)>0) 
	{
		$YourAPIKey = 'dd5e4295-58a0-11e6-a8cd-00163ef91450';
		$From = "GRAYKT";
		if(strlen($otp_array['mobile_no']) >=10)
		{
			$To = $otp_array['mobile_no'];
			$TemplateName = "GK";
			$VAR1 = $otp_array['mobile_otp'];
			//$VAR2="<VAR2>";
			//$VAR3="<VAR3>";
			//$VAR4="<VAR4>";
			//$VAR5="<VAR5>";
			### DO NOT Change anything below this line
			$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
			$url = "https://2factor.in/API/V1/$YourAPIKey/ADDON_SERVICES/SEND/TSMS"; 
			$ch = curl_init(); 
			curl_setopt($ch,CURLOPT_URL,$url); 
			curl_setopt($ch,CURLOPT_POST,true); 
			//curl_setopt($ch,CURLOPT_POSTFIELDS,"TemplateName=$TemplateName&From=$From&To=$To&VAR1=$VAR1&VAR2=$VAR2&VAR3=$VAR3&VAR4=$VAR4&VAR5=$VAR5"); 
			curl_setopt($ch,CURLOPT_POSTFIELDS,"TemplateName=$TemplateName&From=$From&To=$To&VAR1=$VAR1"); 
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
			$otp_response = curl_exec($ch);
			$otp_response_array = json_decode($otp_response, true);
			//print_r($otp_response_array);
			$otp_err = curl_error($ch);
			curl_close($ch);

			if($otp_response_array['Status'] == 'Success') 
			{
				return 1;
				exit();
			} 
			else 
			{
				return 0;
				exit();
			}
		}
		else
		{
			return 0;
			exit();
		}
	}
	else
	{
		return 0;
		exit();
	}
}
?>
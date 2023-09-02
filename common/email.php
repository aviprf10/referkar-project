<?php
function send_email($email_array)
{

   $cancel_order_date='';
   $cancel_order_reason='';
   $company_title = 'referkar.com';
   $from_email = 'support@referkar.com';
   $contact_mobile = "+91 1234567890";
   $selected_currency_text = 'Rs.';
   $base_url = 'https://www.referkar.com/';
   $email_images=$base_url.'email_images/';

   $total_mail = 1;
   $send_email = 0; 
   $user_name = $email_array['user_name'];
   $receiver_email= $email_array['email'];
   $email_type= $email_array['email_type'];
   /*$social_media_link_array = $email_array['social_media_link'];
   	if(count($social_media_link_array)>0)
	{
   		foreach ($social_media_link_array as $social_media_link) 
		{
			$facebook_link = $social_media_link['facebook_link'];
			$google_plus_link = $social_media_link['google_plus_link'];
			$instagram_link = $social_media_link['instagram_link'];
			$pintrest_link = $social_media_link['pinterest_link'];
			$youtube_link = $social_media_link['youtube_link'];
			$twitter_link = $social_media_link['twitter_link'];
		}
	}*/
	$facebook_link = '#';
	$twitter_link = '#';
	$pintrest_link = '#';
	$instagram_link = '#';
	$linkdin_link = '#';
	
	
   $mail = new PHPMailer\PHPMailer\PHPMailer();
	//$mail->SMTPDebug = 3;
	$mail->Host = 'mail.referkar.com';
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = 'support@referkar.com';
	$mail->Password = '*#X8W(BzX=(s';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->CharSet = 'UTF-8';
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->setFrom($from_email, $company_title);
	$mail->addAddress($receiver_email, $user_name);
	$mail->addReplyTo($from_email, $company_title);
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);  
	
                
	$email_body = '';
	$send_email = 0;

	$email_header = 
	'<!DOCTYPE html>
		<html lang="en">
		   	<head>
		      <meta charset="utf-8"/>
		      <title></title>
		   	</head>
		   	<body>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable">
				   <tbody>
				      <tr>
				         <td align="center" valign="top">
				            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="logoTable" style="">
				               <tbody>
				                  <tr>
				                     <td align="center" valign="middle" style="padding-top:40px;padding-bottom:40px"><a href="#" style="text-decoration:none"><img alt="" border="0"  src="'.$email_images.'logo.png" style="height:auto;display:block" width="180"></a></td>
				                  </tr>
				               </tbody>
				            </table>
				         </td>
				      </tr>
				   </tbody>
				</table>';
	 
				$email_body = '';
				$email_footer = 
						'<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" >
							<tbody>
							   <tr>
							      <td align="center" valign="top" class="footerCell">
							         <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
							            <tbody>
							               <tr>
							                  <td height="20" style="font-size:1px;line-height:1px;">&nbsp;</td>
							               </tr>
							            </tbody>
							         </table>
							      </td>
							   </tr>
							   <tr>
							      <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
							   </tr>
							</tbody>
						</table>
				</body>
			</html>';


	if($email_type == 1) // send otp
	{
		$send_email = 1;
		$otp_number = $email_array['generate_otp'];
		//$subject = "Password Reset Link";
		$mail->Subject = "Verification OTP Number";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
                        <tr>
                           <td align="center" valign="top">
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
                                 <tbody>
                                    <tr>
                                       <td style="background-color:#e9570e;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                    
                                       <td align="center" valign="top" class="title" style="padding-bottom:5px;padding-left:20px;padding-right:20px">
                                          <h2 class="bigTitle"  style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">OTP</h2>
                                       </td
                                    <tr>
                                       <td align="center" valign="top" class="description" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <p class="midText"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0">Your otp number is '.$otp_number.'
		                               </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
    }
	else if($email_type == 2) // Registeration Done Email
	{
		$send_email = 1;
		$login_email = $email_array['email'];
		$user_name = $email_array['user_name'];
		$unique_key = $email_array['unique_key'];

		$mail->Subject = "Welcome To ".$company_title."";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
		                        <tr>
		                           <td align="center" valign="top">
		                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
		                                 <tbody>
		                                    <tr>
		                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
		                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">You have successfully registration on '.$company_title.'</h4>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="description" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <p class="midText"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0">Thank you for joining with '.$company_title.', We have more than a 6 million Readers Each Month, keeping you up to date with what is going on in the world.</p>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <table border="0" cellpadding="0" cellspacing="0" align="center">
                                             <tbody>
                                                <tr>
                                                   <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"><a href="'.$base_url.'" style="color:#fff !important;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:600;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block;padding-top:10px;padding-bottom:10px;padding-left:25px;padding-right:25px;" target="_blank">Explore Now</a></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
	}
	else if($email_type == 3) // Order Done Mail
	{
		$send_email = 1;
		$loan_uniquie_key = $email_array['loan_uniquie_key'];
		$name = $email_array['name'];
		$email = $email_array['email'];
		$mobile = $email_array['mobile'];
		$refer_name = $email_array['refer_name'];
		$refer_email = $email_array['refer_email'];
		$refer_mobile = $email_array['refer_mobile'];

		$mail->Subject = "Your reference details ";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
			<tbody>
			   <tr>
			      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
			         <!--[if (gte mso 9)|(IE)]>
			         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
			            <tr>
			               <td align=center valign=top>
			                  <![endif]-->
			                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
			                     <tbody>
			                        <tr>
			                           <td align="center" valign="top">
			                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
			                                 <tbody>
			                                    <tr>
			                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
			                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
	                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
	                                       </td>
	                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
	                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">Thank you! for referring us. We are working on it we will update you soon</h4>
	                                       </td>
	                                    </tr>
													<tr>
			                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi '.$name.'!</td>
				                        </tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Name. : &nbsp;'.$name.' </td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Email : &nbsp;</b>'.$email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Mobile : &nbsp;</b>'.$mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Name : &nbsp;</b>'.$refer_name.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Email : &nbsp;</b>'.$refer_email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Mobile : &nbsp;</b>'.$refer_mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Reference Number : &nbsp;</b>'.$loan_uniquie_key.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Check your reference status : &nbsp;</b><a href="'.$base_url.'track-refrencenum" target="_blank">Click Now</a></td>
												</tr>
			                           <tr>
			                              <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
			                                 <table border="0" cellpadding="0" cellspacing="0" align="center">
			                                    <tbody>
			                                       <tr>
			                                          <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
			                                       </tr>
			                                    </tbody>
			                                 </table>
			                              </td>
			                           </tr>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
			                        <tbody>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                  </td>
			               </tr>
			            </tbody>
			         </table>
			         <!--[if (gte mso 9)|(IE)]><![endif]-->
			      </td>
			   </tr>
			   </tbody>
			</table>';
	}
	else if($email_type == 4) // Order Done Mail
	{
		$send_email = 1;
		$loan_uniquie_key = $email_array['loan_uniquie_key'];
		$name = $email_array['name'];
		$email = $email_array['temail'];
		$mobile = $email_array['mobile'];
		$refer_name = $email_array['refer_name'];
		$refer_email = $email_array['refer_email'];
		$refer_mobile = $email_array['refer_mobile'];

		$mail->Subject = "New Inquiry ";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
			<tbody>
			   <tr>
			      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
			         <!--[if (gte mso 9)|(IE)]>
			         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
			            <tr>
			               <td align=center valign=top>
			                  <![endif]-->
			                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
			                     <tbody>
			                        <tr>
			                           <td align="center" valign="top">
			                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
			                                 <tbody>
			                                    <tr>
			                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
			                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
	                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
	                                       </td>
	                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
	                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">We have a new inquiry the details are bellow</h4>
	                                       </td>
	                                    </tr>
													<tr>
			                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi Admin</td>
				                           </tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Name. :  &nbsp;'.$name.' </td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Email : &nbsp;</b>'.$email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Mobile : &nbsp;</b>'.$mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Name : &nbsp;</b>'.$refer_name.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Email : &nbsp;</b>'.$refer_email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Mobile : &nbsp;</b>'.$refer_mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Mobile : &nbsp;</b>'.$refer_mobile.'</td>
												</tr>
												<tr>
			                              <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
			                                 <table border="0" cellpadding="0" cellspacing="0" align="center">
			                                    <tbody>
			                                       <tr>
			                                          <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
			                                       </tr>
			                                    </tbody>
			                                 </table>
			                              </td>
			                           </tr>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
			                        <tbody>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                  </td>
			               </tr>
			            </tbody>
			         </table>
			         <!--[if (gte mso 9)|(IE)]><![endif]-->
			      </td>
			   </tr>
			   </tbody>
			</table>';
	}
	else if($email_type == 5) // Order Done Mail
	{
		$send_email = 1;
		$loan_uniquie_key = $email_array['loan_uniquie_key'];
		$name = $email_array['name'];
		$email = $email_array['temail'];
		$mobile = $email_array['mobile'];
		$refer_name = $email_array['refer_name'];
		$refer_email = $email_array['refer_email'];
		$refer_mobile = $email_array['refer_mobile'];

		$mail->Subject = "New Inquiry ";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
			<tbody>
			   <tr>
			      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
			         <!--[if (gte mso 9)|(IE)]>
			         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
			            <tr>
			               <td align=center valign=top>
			                  <![endif]-->
			                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
			                     <tbody>
			                        <tr>
			                           <td align="center" valign="top">
			                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
			                                 <tbody>
			                                    <tr>
			                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
			                                    </tr>
	                                     <tr>
	                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
	                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
	                                       </td>
	                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
	                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">We have a new inquiry the details are bellow</h4>
	                                       </td>
	                                    </tr>
													<tr>
			                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi Admin!</td>
						                        </tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Name. :  &nbsp;'.$name.' </td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Email : &nbsp;</b>'.$email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Mobile : &nbsp;</b>'.$mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Name : &nbsp;</b>'.$refer_name.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Email : &nbsp;</b>'.$refer_email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Mobile : &nbsp;</b>'.$refer_mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Reference No. : &nbsp;</b>'.$loan_uniquie_key.'</td>
												</tr>
												<tr>
			                              <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
			                                 <table border="0" cellpadding="0" cellspacing="0" align="center">
			                                    <tbody>
			                                       <tr>
			                                          <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
			                                       </tr>
			                                    </tbody>
			                                 </table>
			                              </td>
			                           </tr>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
			                        <tbody>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                  </td>
			               </tr>
			            </tbody>
			         </table>
			         <!--[if (gte mso 9)|(IE)]><![endif]-->
			      </td>
			   </tr>
			   </tbody>
			</table>';
	}
	else if($email_type == 6) // Order Done Mail
	{
		$send_email = 1;
		$loan_uniquie_key = $email_array['loan_uniquie_key'];
		$name = $email_array['name'];
		$email = $email_array['temail'];
		$mobile = $email_array['mobile'];
		$refer_name = $email_array['refer_name'];
		$refer_email = $email_array['refer_email'];
		$refer_mobile = $email_array['refer_mobile'];

		$mail->Subject = "New Inquiry ";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
			<tbody>
			   <tr>
			      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
			         <!--[if (gte mso 9)|(IE)]>
			         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
			            <tr>
			               <td align=center valign=top>
			                  <![endif]-->
			                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
			                     <tbody>
			                        <tr>
			                           <td align="center" valign="top">
			                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
			                                 <tbody>
			                                    <tr>
			                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
			                                    </tr>
	                                     <tr>
	                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
	                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
	                                       </td>
	                                    </tr>
	                                    <tr>
	                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
	                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">We have a new inquiry the details are bellow</h4>
	                                       </td>
	                                    </tr>
													<tr>
			                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi Admin!</td>
				                        	</tr>
										
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Name. : '.$name.' </td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Email :</b>'.$email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Mobile :</b>'.$mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Name :</b>'.$refer_name.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Email :</b>'.$refer_email.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Refer Mobile :</b>'.$refer_mobile.'</td>
												</tr>
												<tr>
													<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Reference No. :</b>'.$loan_uniquie_key.'</td>
												</tr>
												<tr>
			                              <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
			                                 <table border="0" cellpadding="0" cellspacing="0" align="center">
			                                    <tbody>
			                                       <tr>
			                                          <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
			                                       </tr>
			                                    </tbody>
			                                 </table>
			                              </td>
			                           </tr>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
			                        <tbody>
			                           <tr>
			                              <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
			                           </tr>
			                        </tbody>
			                     </table>
			                  </td>
			               </tr>
			            </tbody>
			         </table>
			         <!--[if (gte mso 9)|(IE)]><![endif]-->
			      </td>
			   </tr>
			   </tbody>
			</table>';
	}

	if($send_email == 1)
	{
		//$mail->Body =  $email_body;
		$mail->Body    =  $email_header.$email_body.$email_footer;
		

   		if($mail->send()) 
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
	return 0;
	exit();
   
}
?>
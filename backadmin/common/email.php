<?php
function send_email($email_array)
{
  $cancel_order_date='';
   $cancel_order_reason='';
   $company_title = 'MCS | Microware Card Solutions';
   $email_type= $email_array['email_type'];
   $from_email = 'contact@peeplog.com';
   $receiver_email= $email_array['email']; 
   $contact_mobile = "+91 1234567890";
   $selected_currency_text = 'Rs.';
   $base_url='localhost/mcs/';
   $email_images=$base_url.'email_images/';
   $total_mail = 1;
   $send_email = 0; 
   $user_name = $email_array['user_name'];
   

   $facebook_link  = '#';
   $twitter_link   = '#';
   $pintrest_link  = '#';
   $instagram_link = '#';
   $linkdin_link   = '#';


   $mail = new PHPMailer;
   //$mail->SMTPDebug = 2;
   $mail->isSMTP();
   $mail->Host = 'webmail.peeplog.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'info@peeplog.com';
   $mail->Password = '2uq2B9,?yW}t';
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
   if($email_type == 4)
   {
      $mail->setFrom($from_email, $user_name);
      $mail->addAddress($receiver_email, $user_name);
      $mail->addReplyTo($from_email, $user_name);
   }
   else
   {    
      $mail->setFrom($from_email, $company_title);
      $mail->addAddress($receiver_email, $user_name);
      $mail->addReplyTo($from_email, $company_title);
   }
	// $mail = new PHPMailer;
	// //$mail->SMTPDebug = 3;
	// $mail->Host = 'smtp.gmail.com';
	// $mail->isSMTP();
	// //$mail->Host = 'localhost';
	// $mail->SMTPAuth = true;
	// $mail->Username = 'info@rmsuits.com';
	// $mail->Password = '}4s?-;DGlBDu';
	// $mail->SMTPSecure = 'tls';
	// $mail->Port = 587;
	// $mail->SMTPOptions = array(
	// 	'ssl' => array(
	// 		'verify_peer' => false,
	// 		'verify_peer_name' => false,
	// 		'allow_self_signed' => true
	// 	)
	// );
	
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


	if($email_type == 1) // welcome mail
	{
		$send_email = 1;
		$temp_no = $email_array['temp_no'];
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
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0" src="'.$email_images.'user-welcome.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
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
	else if($email_type == 2) // Registeration Done Email
	{
		$send_email = 1;
		$uniqueid = $email_array['uniqueid'];
		$name = $email_array['name'];

		//$subject1 = "Registration Done";
		$mail->Subject = "Customer Feedback";
		$email_body .= 
		'<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="left" bgcolor="#ededed" >
         <tr><td><table cellpadding="0" cellspacing="0" border="0"><tr><td>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
         <tr><td align="left" height="5" valign="middle"></td></tr><tr><td width="30"></td>
         <td align="left" height="0" valign="middle"><h2><b><span  style="color:#ff7004">MCS | Microware Card Solutions</span></b></h2></td></tr><tr><td align="left" height="10" valign="middle"></td></tr></table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff" >
         <tr><td align="left" height="10" valign="middle"></td></tr>
         <tr>
            <td width="30"></td>
            <td align="left" height="0" valign="middle">
               <h3>Hi '.$name.',</h3>
               <p>Please Click and submit feedback:</p>
            </td>
         </tr>
      </table>
      <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff" >
         <tr><td align="left" height="10" valign="middle"></td></tr>
         <tr>
            <td width="30"></td>
            <td align="left" height="0" valign="middle">
               <a href="'.$base_url.'customer-feedback/'.$uniqueid.'" style="color:#fff; background-color:#5cb85c; border-color:#4cae4c; padding:7px 18px; border:1px solid transparent; border-radius:4px; font-size:15px; text-decoration:none"><strong>Click Now</strong></a>
            </td>
         </tr>
      </table>
      <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
         <tr>
            <td width="30"></td>
            <td align="left" valign="middle">
               <p style="font-size:14px">Regards,</p>
               <p style="font-size:16px"><strong>MCS Team</strong></p>
            </td>
         </tr>
         <tr><td align="left" height="5" valign="middle"></td></tr>
      </table>
      <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
         <tr><td align="left" height="30" valign="middle"></td></tr>
         <tr>
            <td width="30"></td>
            <td align="left" height="0" valign="middle">
            <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
               <p>
                  <a href="'.$base_url.'about">
                     <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                        About
                       </font>
                    </a> |
                  <a href="'.$base_url.'contact-us">
                     <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                        Contact
                     </font>     
                  </a>
               </p>
            </font>  
            </td>
         </tr>
         <tr><td align="left" height="10" valign="middle"></td></tr>
      </table>
      </td></tr></table></td><td width="57"></td></tr></table></td></tr></table>
      </td></tr></table>';
	}
	else if($email_type == 3) //Forgot Password Link
	{
		$send_email = 1;
		$unique_key = $email_array['unique_key'];
		$reset_pswd_link = ''.$base_url.'reset-password/'.$unique_key.'';
		$mail->Subject = "Password Reset Link";
		$email_body .= 
		'<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="left" bgcolor="#ededed" >
         <tr><td><table cellpadding="0" cellspacing="0" border="0"><tr><td>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
               <tr><td align="left" height="5" valign="middle"></td></tr><tr><td width="30"></td>
               <td align="left" height="0" valign="middle"><h2><b><span style="color:#870014">Peeplog</span></b></h2></td></tr>
               <tr><td align="left" height="10" valign="middle"></td></tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr><td align="left" height="10" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">
                  <h3>Hi '.$user_name.',</h3>
                  <p>There was a request to change your password.</p>
               </td>
            </tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr><td align="left" height="10" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">
                  <a href="'.$reset_pswd_link.'" style="color:#fff; background-color:#5cb85c; border-color:#4cae4c; padding:7px 18px; border:1px solid transparent; border-radius:4px; font-size:15px; text-decoration:none"><strong>Change Password</strong></a>
               </td>
            </tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr><td align="left" height="15" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">
                  <p>If you did not make this request, please ignore this email; your password will not change.</p>
               </td>
            </tr>
            <tr><td align="left" height="5" valign="middle"></td></tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr>
               <td width="30"></td>
               <td align="left" valign="middle">
                  <p style="font-size:14px">Regards,</p>
                  <p style="font-size:16px"><strong>Peeplog Team</strong></p>
               </td>
            </tr>
            <tr><td align="left" height="5" valign="middle"></td></tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
            <tr><td align="left" height="30" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">
               <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                  <p>
                     <a href="'.$base_url.'about">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           About
                        </font>
                     </a> |
                     <a href="'.$base_url.'feedback">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           Feedback
                        </font>     
                     </a> | 
                     <a href="'.$base_url.'invitefrnd">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           Invite
                        </font>
                     </a>
                  </p>
               </font>  
               </td>
            </tr>
            <tr><td align="left" height="10" valign="middle"></td></tr>
         </table>
         </td></tr></table></td><td width="57"></td></tr></table></td></tr></table>
         </td></tr>
      </table>';
	}
	else if($email_type == 4) //Feedback 
   {
      $send_email = 1;
      $name = $email_array['name'];
      $useremail = $email_array['email'];
      $subject = $email_array['subject'];
      $description = $email_array['description'];
      $mail->Subject = "Peeplog Feedback lead";
      $email_body .= 
      '<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ededed">
         <tr><td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="left" bgcolor="#ededed" >
         <tr><td><table cellpadding="0" cellspacing="0" border="0"><tr><td>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
               <tr><td align="left" height="5" valign="middle"></td></tr><tr><td width="30"></td>
               <td align="left" height="0" valign="middle"><h2><b><span style="color:#870014">Peeplog</span></b></h2></td></tr>
               <tr><td align="left" height="10" valign="middle"></td></tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr><td align="left" height="10" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">Name : '.$name.'</td>
            </tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">Email : '.$useremail.'</td>
            </tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">Subject : '.$subject.'</td>
            </tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">Description : '.$description.'</td>
            </tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff">
            <tr>
               <td width="30"></td>
               <td align="left" valign="middle">
                  <p style="font-size:14px">Regards,</p>
                  <p style="font-size:16px"><strong>Peeplog Team</strong></p>
               </td>
            </tr>
            <tr><td align="left" height="5" valign="middle"></td></tr>
         </table>
         <table width="600" cellpadding="0" cellspacing="0" align="center" bgcolor="#ededed">
            <tr><td align="left" height="30" valign="middle"></td></tr>
            <tr>
               <td width="30"></td>
               <td align="left" height="0" valign="middle">
               <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                  <p>
                     <a href="'.$base_url.'about">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           About
                        </font>
                     </a> |
                     <a href="'.$base_url.'feedback">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           Feedback
                        </font>     
                     </a> | 
                     <a href="'.$base_url.'invitefrnd">
                        <font color="#333" face="Verdana, Geneva, sans-serif" size="2">
                           Invite
                        </font>
                     </a>
                  </p>
               </font>  
               </td>
            </tr>
            <tr><td align="left" height="10" valign="middle"></td></tr>
         </table>
         </td></tr></table></td><td width="57"></td></tr></table></td></tr></table>
         </td></tr>
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
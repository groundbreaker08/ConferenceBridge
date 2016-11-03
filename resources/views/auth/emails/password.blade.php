<html>
<body style="background: #fbfbfb;">
<div link="#c6d4df" alink="#c6d4df" vlink="#c6d4df" text="#c6d4df" style="font-family:Helvetica,Arial,sans-serif;font-size:14px;color: #c6d4df;">
    <table style="border: 1px solid #ee1b24;width:538px;" align="center" cellspacing="0" cellpadding="0">
        <tbody><tr>
            <td style="height:65px;background-color: #ffffff;border-bottom: 1px solid #ffffff;padding-left:20px">
                <img src="<?php echo $message->embed(base_path('assets/images/sonicicon128x128.jpg')); ?>" width="100px" alt="Sonic"/>
            </td>
        </tr>
        <tr>
            <td bgcolor="#c62828">
                <table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

                    <tbody>
                    <tr bgcolor="#c62828">
                        <td style="padding:32px 0 16px 12px;font-size:15px;color: white;font-family:Calibri,serif;">
                            Dear {{ucwords($user->firstname)}},
                            <div style="height:15px">&nbsp;</div>
                            To get back into your Balch Conference account, you'll need to create a new password.
                            <div style="height:15px">&nbsp;</div>
                            Click on 'Reset my password' button below.
                            <div style="height:15px">&nbsp;</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <div><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" style="height:40px;v-text-anchor:middle;width:200px;" arcsize="10%" strokecolor="#8e0000" fillcolor="#ffffff">
                                    <w:anchorlock/>
                                    <center style="color:#8e0000;font-family:sans-serif;font-size:13px;font-weight:bold;">Reset my password</center>
                                </v:roundrect>
                                <![endif]--><a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" style="background-color:#ffffff;border:1px solid #8e0000;border-radius:4px;color:#8e0000;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">Reset my password</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="word-break:break-all;padding:32px 0 16px 12px;font-size:15px;color: white;font-family:Calibri,serif;">
                            <span>'Reset my password' not working? </span>, copy and paste below link to your browser:
                            <div style="height:15px">&nbsp;</div>
                            {{ $link }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 0 16px 12px;font-size:15px;color:white;font-family:Calibri,serif;">
                            Your sincerely,
                            <br>
                            Sonic Team
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>

        <tr>
            <td bgcolor="#000000" style="background-color: #ffffff;padding:32px 0 32px 0;">
                <table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr valign="top">
                        <td width="350" valign="top">
                            <span style="color:#999999;font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif">Sonic Corporation. All rights reserved. All trademarks are property of their respective owners in China and other countries</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#999999;font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif">
                            Didn't ask for help with your password? <a href="sonic-manager@sonic-teleservices.com">Let us know right away</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div></div>
</body>
</html>

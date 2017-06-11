<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Rawat Taman Postman</title>
	</head>
	<body style="margin:0px;
				padding:0px;
				border: 0 none;
				font-size: 11px;
				font-family: Verdana, sans-serif;
				">
		<table style="margin-button: 50px; width: 650px; margin: auto auto auto auto; border: 1px #fff solid; background: #fff; font-size: 12px; font-family: Verdana, sans-serif;" align="center">
			<tbody>
				<tr>
					<td style="color: #fff; background:red;text-align:center">
						<h2>CUSTOMER FEEDBACK</h2>
					</td>
				</tr>
				<tr>
					<td>
						<table style="font-size: 12px; font-family: Verdana, sans-serif;">
							<tr>
								<td style="width: 90px; color:black; background:white;text-align:left">
									FROM
								</td>
								<td style="color:black; background:white;text-align:left">
									:
								</td>
								<td style="color:black; background:white;text-align:left">
									<?=$modelUser->email?>
								</td>
							</tr>
							<tr>
								<td style="color:black; background:white;text-align:left">
									EVENT SEND
								</td>
								<td style="color:black; background:white;text-align:left">
									:
								</td>
								<td style="color:black; background:white;text-align:left">
									FEEDBACK
								</td>
							</tr>
							<tr>
								<td style="color:black; background:white;text-align:left">
									NAME
								</td>
								<td style="color:black; background:white;text-align:left">
									:
								</td>
								<td style="color:black; background:white;text-align:left">
									<?=$modelUser->username?>
								</td>
							</tr>							
							<tr>
								<td style="color:black; background:white;text-align:left">
									MESSAGE
								</td>
								<td style="color:black; background:white;text-align:left">
									:
								</td>
								<td style="color:black; background:white;text-align:left">
									<?=$NOTE?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td style="padding: 9px; color:red; background:white;text-align:center">
						This email message has been automatically generated, Please do not reply to this message.
					</td>
				</tr>
				<tr>
					<td colspan="2" style="background: #ddd; padding: 9px; margin-top:5px; margin-button: 18px; text-align: center;">
						&copy;RawatTaman 2017/2018
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>

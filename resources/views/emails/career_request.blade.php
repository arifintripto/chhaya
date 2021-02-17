<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<p>Hello {{$data['firstname']}},</p>
		<p>Thank you for applying to the <b>{{strtoupper($data['job_title'])}}</b> position.</p><br />
		<p>We'd like to inform you that we received your resume. Our hiring team is currently reviewing all applications and we are planning to schedule interviews shortly. If you are among qualified candidates, you will receive call/E-Mail from one of our recruiters to schedule phone interview. In any case, we will keep you posted on the status of your application.</p><br />

		<p>Thanking You</p>
		<h3>Team HR <br>Virtual Market Solution Inc.</h3>
		<img style="width:50px;height:50px" src="https://vmsinc.us/frontend/default/images/vmsi.png">
	</body>
</html>

<!DOCTYPE html>
<html>
<head>	
	<title>Responsive Login Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<form action="/auth" method="post">
			<label for="username">Username:</label><br>
			<input type="text" id="username" name="username" required><br>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" required><br>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>
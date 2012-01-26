<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<title>Register User</title>
	<style>
			label {
			display:inline-block;
			width:130px;
			text-align:right;
			padding-right:2px;
			}
			input[type="submit"] {
			margin-left:235px;
			}
	</style>
	</head>

	<body>
	<h1>Account Registration</h1>
		<form action="wp-content/plugins/supportland/lib/register.php" method="post" id="account_regirster">
  			<p>
    			<label for="fname">First Name:</label>
    			<input type="text" name="fname" id="fname">
  			</p>
  			<p>
    			<label for="lname">Last Name:</label>
    			<input type="text" name="lname" id="lname">
  			</p>
  			<p>
    			<label for="email">Username:</label>
    			<input type="email" name="email" id="email">
  			</p>
  			<p>
    			<label for="password">Password:</label>
    			<input type="password" name="passwordd" id="password">
  			</p>
  			<p>
    			<label for="password2">Confirm Password:</label>
    			<input type="password" name="password2" id="password2">
  			</p>
  			<p>
    			<input type="submit" name="register" id="register" value="Submit">
  			</p>
		</form>
	</body>
</html>
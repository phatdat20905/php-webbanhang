<?php 
	include '../classes/adminlogin.php';
?>
<?php
    $class = new Adminlogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);

		$login_check = $class->login_admin($adminUser, $adminPass);
    }
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color: red;"><?php echo isset($login_check)? $login_check : '';?></span> <!-- error message -->
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
<?php  

session_start();

include('connection.php');

$username = "";
$fullname = "";
$email = "";
$pwd = "";
$confirm_pwd = "";

$isValid = TRUE;
$isOk = TRUE;

$isPost = $_SERVER['REQUEST_METHOD'] == 'POST';

$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	
	$count=$stmt->rowCount();

	$rows = $stmt->fetchAll();
	
	if($count > 0)
	{
		
		$_SESSION["user"] = $rows[0];

		unset($_SESSION['user']['password']);

		if (isset($_POST["remember"]))
		{
			setcookie("username", $_POST["username"] . $_POST["pwd"], time() + 60 * 60 * 24 * 365);
			
	 	}
	 	else
	 	{
	 		setcookie("username", $_POST["username"] . $_POST["pwd"], time()-1);
		}
	}
	header("Location: index.php");
	exit;

if($isPost){
	$username = $_POST["username"];
	$fullname = $_REQUEST["fullname"];
	$email = $_REQUEST["email"];
	$pwd = $_REQUEST["pwd"];
	$confirm_pwd = $_REQUEST["confirm_pwd"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="POST">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" required/>
						<?php if ($isPost && !preg_match("/^\w{4,}$/", $username)):$isValid = false;?>
							<span class = "error">Required field</span>
						<?php endif?>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" required/>
						<?php if ($isPost && !preg_match("/^([a-zA-Z]+\s{1}[a-zA-Z]{1,})$/", $fullname)):$isValid = false;?>
							<span class = "error">Required field</span>
						<?php endif?>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" />
						<?php if ($isPost && !preg_match("/[a-zA-z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+/", $email)):$isValid = false;?>
							<span class = "error">Required field</span>
						<?php endif?>
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" required/>
						<?php if ($isPost && (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pwd) || $pwd!=$confirm_pwd)): $isValid=false; ?>
							<span class="error">Required field</span>	
						<?php endif ?>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>

	</body>
</html>
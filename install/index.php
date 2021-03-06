<?php
session_start();
if (isset($_SESSION['host'])){
	$host = $_SESSION['host'];
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$db = $_SESSION['db'];
} else {
	$host = "";
	$user = "";
	$pass = "";
	$db = "";
}

$configFile = dirname( dirname(__FILE__) ).'/config.ini';
$config = parse_ini_file($configFile, true);

if ($config['settings']['lang'] == "en") {
	include dirname( dirname(__FILE__) )."/lang/en.php";
	$LANG = "en";
} elseif ($config['settings']['lang'] == "hu") {
	include dirname( dirname(__FILE__) )."/lang/hu.php";
	$LANG = "hu";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Whiteboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../functions/interactWithDatabase.js"></script>
	<script src="install.js"></script>

</head>
<body>
<div class="container">
	<div class="page-header">
		<h1 align="center"><?php echo $lang['installTitle']; ?></h1>
	</div>

	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-md-5">
		<h3><?php echo $lang['loginTitle']; ?></h3><br>
		<form id = "sql-data">
			<div class="form-group">
				<label for="lang"><?php echo $lang['lang']; ?></label>
				<select id="lang" class="form-control" onchange="changeLang();">
					<option value="en" <?php if ($LANG == "en") { echo 'selected = "selected"'; } ?> >English</option>
					<option value="hu" <?php if ($LANG == "hu") { echo 'selected = "selected"'; } ?>>Magyar</option>
				</select>
			</div>

			<div class="form-group">
			<label for="host"><?php echo $lang['host']; ?></label>
			<input type="text" class="form-control" id="host" placeholder="localhost" onkeyup="checkInput();" autofocus value="<?php echo htmlspecialchars($host); ?>">
			</div>

			<div class="form-group">
			<label for="user"><?php echo $lang['username']; ?></label>
			<input type="text" class="form-control" id="user" placeholder="root" onkeyup="checkInput();" value="<?php echo htmlspecialchars($user); ?>">
			</div>

			<div class="form-group">
			<label for="pass"><?php echo $lang['password']; ?></label>
			<input type="password" class="form-control" id="pass" placeholder="••••••••••••" onkeyup="checkInput();" value="<?php echo htmlspecialchars($pass); ?>">
			</div>	

			<div class="form-group">
			<label for="db"><?php echo $lang['database']; ?></label>
			<input type="text" class="form-control" id="db" placeholder="WHITEBOARD" aria-describedby="dbHelpBlock"  onkeyup="checkInput();" value="<?php echo htmlspecialchars($db); ?>">
			<p id="passwordHelpBlock" class="form-text text-muted">
				<?php echo $lang['ifDb']; ?>
			</p>
			</div>		
			
			<div class="text-center">
			<br>
			<button type="button" id="submitButton" class="btn btn-success disabled btn-lg" onclick="submitLogin();" disabled><?php echo $lang['login']; ?></button>

			</div>
			</form>
			<script type="text/javascript">checkInput();</script>
		</div>
		<div class="col-md-5" id="resultDisplay">

			
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>

</body>

</html>
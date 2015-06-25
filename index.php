<?php 
session_start();
include_once('class_admin.php');
$admin = new Admin();
if(isset($_POST['login']))
{
	$user = trim(strip_tags($_POST['user']));
	$pass = trim(strip_tags($_POST['pass']));
	$level = trim(strip_tags($_POST['level']));
	if($admin->login($user, $pass, $level))
	{
		$_SESSION['id'] = $user;
		$_SESSION['level'] = $level;
		header('location:index.php');
	}
	else
	{
		$msg = 'Error : Login Gagal..';
	}
}
if(isset($_GET['logout']))
{
	session_destroy();
	header('location:index.php');
}
if(!$admin->cekSession())
{
?>
<html>
<head>
	<title>Simple Multi Login PDO OOP</title>
	<style>
		form {border:2px solid red;background:pink;padding:10px;margin:1em auto;width:350px;}
		input,select {border:1px solid orange;padding:7px;margin-top:3px;width:100%;}
	</style>
</head>
<body>
<form method="post">
<center><?php print $msg = isset($msg) ? $msg : ''; ?></center>
<pre>
<input type="text" name="user" placeholder="Masukan Username">
<input type="password" name="pass" placeholder="Masukan Password">
<select name="level">
	<option value="">Pilih Level</option>
	<option value="1">Super User</option>
	<option value="2">Admin</option>
</select>
<input type="submit" name="login" value="Login">
</pre>
<center>
<small> By EHaKu | <b>Note: </b> Password dalam bentuk <b>crypt</b> bukan md5 <small>
</center>
</form>
</body>
</html>
<?php } ?>

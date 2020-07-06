<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
    <body>
    <h2>Delete user</h2>
        <form action="" method="post">
            Password: <input type="text" name="passwd" value="" />
            <input class="delete" type="submit" name="submit" value="Delete" />
        </form>
		<br />
    </body>
</html>

<?php
require_once 'auth.php';
session_start();
if ($_POST['submit'] === 'Delete' && auth($_SESSION['logged_on_user'], $_POST['passwd']))
{
	$filename = 'private/passwd';
    $str = file_get_contents($filename);
	$array = unserialize($str);
	$i = 0;

    foreach ($array as $key => $value)
    {
        if ($value['login'] === $_SESSION['logged_on_user'])
		{	
			array_splice($array, $i, 1);
			break ;
		}
		$i++;
	}
	$data = serialize($array);
	file_put_contents($filename, $data);
	header("Location: logout.php");
}
else if ($_POST['submit'] === 'Delete' && !auth($_SESSION['logged_on_user'], $_POST['passwd']))
	echo "ERROR: Incorrect password.";
?>
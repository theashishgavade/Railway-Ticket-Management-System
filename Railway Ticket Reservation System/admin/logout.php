<?php 
if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}

unset($_SESSION['logged']);

header('Location: index.php');

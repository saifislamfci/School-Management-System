<?php
ob_start();
session_start();
spl_autoload_register(function($classes){
	require_once("classes/$classes".".php");
});
require_once('functions.php');
<?php

// DB & URL SERVER
$db = new PDO("mysql:host=localhost;dbname=immobilier", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

define("ROOT", dirname($_SERVER["SCRIPT_FILENAME"]) . "/");
define("URL", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["SCRIPT_NAME"]) . "/");


// XSS
foreach($_POST as $key => $value)
{
    $_POST[$key] = htmlspecialchars(trim($value));
}
foreach($_GET as $key => $value)
{
    $_GET[$key] = htmlspecialchars(trim($value));
}

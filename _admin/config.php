<?php

$host = 'localhost';
$dbname = 'videogames';
$username = 'root';
$password = '';

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
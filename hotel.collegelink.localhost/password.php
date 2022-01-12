<?php
$password='this is a staong hash';
$hash =password_hash($password,PASSWORD_BCRYPT);
var_dump($hash);

$verified=password_verify($password,$hash);
var_dump($verified);
<?php
require('classes/login.php');

$validador = new Login();

session_start();

$validador->logout();

<?php
session_start();

$sessionUser = $_SESSION['username'];

require_once('../tpl/user-logged.tpl.php');
?>
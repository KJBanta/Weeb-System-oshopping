<?php

@include 'db_connect.php';

session_start();
session_unset();
session_destroy();

header('location:login_forms.php');

?>
<?php
// logout.php
session_start();
require_once 'functions.php';

logoutUser();
header('Location: index.php'); // Перенаправляем на главную страницу после выхода
exit;

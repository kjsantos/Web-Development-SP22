<!DOCTYPE html>

<?php 

include('header.php');
include_once('login.php');

session_start();
session_destroy();

echo "<br><br><h2 class=\"mt-6\" align=\"center\" style=\"margin-top: 150px\">Logout successful, redirecting...</h2>";

header("Refresh: 1; index.php");
exit();
?>

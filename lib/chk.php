<?php
session_start();
if(!isset($_SESSION['name'])) {
   echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
   echo "<script charset='utf-8' language='javascript' type='text/javascript'>window.alert('非法登录或登录超时，请重新登录~');</script>"; 
   echo "<script>window.location.href='login.php';</script>";
   exit();
}
?>